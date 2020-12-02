package com.example.musicsapp;

import android.annotation.TargetApi;
import android.app.Notification;
import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.app.Service;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.os.Binder;
import android.os.IBinder;
import android.util.Log;
import androidx.localbroadcastmanager.content.LocalBroadcastManager;
import java.io.IOException;



public class PlayerService extends Service {

    MediaPlayer mediaPlayer = new MediaPlayer();

    /**===== RETURN TO THE CALLING ACTIVITIES TO BINDED TO THE SERVICES
     * The binder active on the flip play and pause button*/
    private final IBinder mBinder = new MyBinder ();
        /**== creating a binder return our playservices class*/
    public class MyBinder extends Binder {
        PlayerService getServices() {
            return PlayerService.this;
        }
    }

    public PlayerService() {
    }

    /**==== Use to initialize thing in differents methods when it comes to services*/
    @Override
    public int onStartCommand(Intent intent, int flags, int startId) {
        /**=== CHECK IF THE URL IS PARSE OVER if url is in intent =================================*/
        if (intent.getStringExtra("url") != null) {

            /**=== When fire up the services, we pass over a little parses of information and its store in Intent */
            /**===== Get url from : Store in intent ,get the data out using get string extra and give it a key => url*/
            playStream(intent.getStringExtra("url"));
        }

        return START_STICKY;
    }

    /**=== Return a kind of communication channel over activities and service*/
    /**======================================================================*/
    @Override
    public IBinder onBind(Intent intent) {
        return mBinder;
    }

    public void playStream (String url){
        /**===== 1st : Check if have media player already existed, but surely have to check instantialy the media */
        if (mediaPlayer != null){ /**=== If its equal to null, its mean it already exist*/
            try {
                /**==== If its already running, cut out the music */
                mediaPlayer.stop();
            } catch (Exception e) {

            }

            /**=== When its stop, set to null to make a fresh mediaplayer variable for the ready next url */
            mediaPlayer = null;
        }
        /**==== After try catch make new media for new url then set to stream type */
        mediaPlayer = new MediaPlayer();
        mediaPlayer.setAudioStreamType(AudioManager.STREAM_MUSIC);

        /**===== Prevent crashing app */
        try {
            mediaPlayer.setDataSource(url);

            /**===== Fire up to listen*/
            mediaPlayer.setOnPreparedListener(new MediaPlayer.OnPreparedListener() {
                @Override
                public void onPrepared(MediaPlayer mp) {
                    /**===== In here, everything that type in here get called only onces the media player is prepared
                     * Onces its prepared start the music */
                    playPlayer();
                }
            });

            /**=== When music end, its will flip button back to Play button*/
            mediaPlayer.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {
                @Override
                public void onCompletion(MediaPlayer mediaPlayer) {
                    flipPlayPauseButton(false);
                }
            });
            /**== Take media player to background thread and prepared to play ( IMPORTANT )
             * without interfering with the fullground thread or UI thread*/
            /**== Prevent application not responding error, KEY to make work smoothly and reponsive*/
            mediaPlayer.prepareAsync();
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    /**=== Create method play activities
     /** PAUSE */
    public void pausePlayer() {
        try {
            mediaPlayer.pause();
            flipPlayPauseButton(false);
        } catch (Exception e) {
            /**=== Print out the error back to ourself  */
            Log.d("EXCEPTION","failed to pause media player");
        }
    }
    /** PLAY */
    public void playPlayer() {
        try {
            getAudioFocus();
            flipPlayPauseButton(true);

            // unregister when music stop
            unregisterReceiver(noisyAudioStreamReceiver);
        } catch (Exception e) {
            /**=== Print out the error back to ourself  */
            Log.d("EXCEPTION","failed to pause media player");
        }
    }



    public void flipPlayPauseButton(boolean isPlaying) {
        /**=== Code allow to comunicate with MainActivity ( main thread )*/
            /**==== This function cannot be created in mainactivity
             * If run a services as a full ground service and app dies in background the services keep running
             * You try to flip a button while service is running on an activities no longer exist App wil CRASH*/

            // Create new intent name changePlayButton
            Intent intent = new Intent("changePlayButton");

            /**==== Add data*/
            intent.putExtra("isPlaying", isPlaying);

            /**==== How to send data to the main*/
            LocalBroadcastManager.getInstance(this).sendBroadcast(intent);
    }

    /**=== create a method to know which one is play or pause */
    public void togglePlayer() {
        try {
            if (mediaPlayer.isPlaying()){
                pausePlayer();
            }
            else {
                playPlayer();
            }
        } catch (Exception e) {
            Log.d("EXCEPTION", "failed to toggle media player");
        }
    }

    // Audio focus section
    private AudioManager am;
    private boolean playBeforeInteruption = false;

    // Methods to grab audio focus
    public void getAudioFocus() {
        am = (AudioManager) this.getBaseContext().getSystemService(Context.AUDIO_SERVICE);

        // request audio focus
        // Audiofocus gain : control all of the sound
        int result = am.requestAudioFocus(AFchangeListener, AudioManager.USE_DEFAULT_STREAM_TYPE, AudioManager.AUDIOFOCUS_GAIN);

        if (result == AudioManager.AUDIOFOCUS_REQUEST_GRANTED) {
            mediaPlayer.start();
            registerReceiver(noisyAudioStreamReceiver, intentFilter);
        }
    }

    AudioManager.OnAudioFocusChangeListener AFchangeListener = new AudioManager.OnAudioFocusChangeListener() {
        @Override
        public void onAudioFocusChange(int focusChange) {
            // Listen to event check for certain event
                // When having phone call or alarm, music will stop and then resume again
            if (focusChange == AudioManager.AUDIOFOCUS_LOSS_TRANSIENT) {
                if (mediaPlayer.isPlaying()){
                    playBeforeInteruption = true;
                }else {
                    playBeforeInteruption = false;
                }
                pausePlayer();
            }else if (focusChange == AudioManager.AUDIOFOCUS_GAIN) {
                if (playBeforeInteruption == true){
                    playPlayer();
                }
            }else if (focusChange == AudioManager.AUDIOFOCUS_LOSS) {
                pausePlayer();
                // Because loss audio focus, need to tell bannding audio focus in this app
                am.abandonAudioFocus(AFchangeListener);
            }
        }
    };

    // Audio rerouted, Grab message from android system to check if unplug something or sthing change
    private class NoisyAudioStreamReceiver extends BroadcastReceiver {
        @Override
        public void onReceive(Context context, Intent intent) {
            if (AudioManager.ACTION_AUDIO_BECOMING_NOISY.equals(intent.getAction())) {
                pausePlayer();
            }
        }
    }

    // Create event
    private IntentFilter intentFilter = new IntentFilter(AudioManager.ACTION_AUDIO_BECOMING_NOISY);

    // Create instance for NoisyAudioStreamReceiver
    private NoisyAudioStreamReceiver noisyAudioStreamReceiver = new NoisyAudioStreamReceiver();
}
