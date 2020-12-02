package com.example.musicsapp;

import android.content.BroadcastReceiver;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.ServiceConnection;
import android.os.Bundle;

import com.google.android.material.floatingactionbutton.FloatingActionButton;

import androidx.appcompat.app.AppCompatActivity;
import androidx.appcompat.widget.Toolbar;
import androidx.localbroadcastmanager.content.LocalBroadcastManager;

import android.os.IBinder;
import android.util.Log;
import android.view.View;

import android.view.Menu;
import android.view.MenuItem;

//====== Control all of the playback of our streaming audio, also control video files and stream
import android.media.MediaPlayer;

//====== Take care of audio sources, output and input on our devices
//====== Playing music speaker, bluetooth headset, headphone... this will take care of it.
import android.widget.AdapterView;
import android.widget.ListView;


import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.List;


public class MainActivity extends AppCompatActivity {

    //Holding list of song
    List<Song> songs = new ArrayList<>();

    // Create listview
    ListView songsListView;

    /**===== MOVE THE FLOATINGBUTTON TO A CLASS LEVEL TO ACCESS INSIDE CODE ======================*/
    static FloatingActionButton playPauseButton ;
    static FloatingActionButton nextButton;
    static FloatingActionButton previousButton;

    /** Create class level to access bind to main activities*/
    PlayerService mBoundServices;

    /** Check services bound or not */

    boolean mServiceBound = false;

    /**======= CREATE SERVICES CONNECTION TO THIS BINDER */
    private ServiceConnection mServiceConnection = new ServiceConnection()  {
        @Override
        public void onServiceConnected(ComponentName componentName, IBinder service) {
            PlayerService.MyBinder myBinder = (PlayerService.MyBinder) service;
            /**=== Grabbing services that brought by myBinder */
            mBoundServices = myBinder.getServices();
            mServiceBound = true;
        }

        @Override
        public void onServiceDisconnected(ComponentName componentName) {
            mServiceBound = false;
        }
    };

    /**==== CREATE A RECEIVER FROM BROADCAST ==================================================== */
    private BroadcastReceiver mMessageReciever = new BroadcastReceiver() {
        @Override
        public void onReceive(Context context, Intent intent) {
            //Extract data for our intent
            boolean isPlaying = intent.getBooleanExtra("isPlaying",false);
            flipPlayPauseButton(isPlaying);
        }
    };
    //===== onCreate : the mainscreen of the app. An onCreate is fire up everytime activity is created.
    //===== When open, rotate onCreate is fire. When comback its will fire depends on condition
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        //====== This set our content view, this grab the layout of our main activity ( activity_main.xml)
        setContentView(R.layout.activity_main);

        //====== Grab toolbar from res ====================================
        Toolbar toolbar = findViewById(R.id.toolbar);

        //====== Set it at top of our app ============================================
        setSupportActionBar(toolbar);

        //====== Grab floating action button and give it some activity =============================
        playPauseButton = findViewById(R.id.fab);

        /**=== ACTION WHEN BUTTON IS CLICKED =====================================================*/
        playPauseButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (mServiceBound) {
                    mBoundServices.togglePlayer();
                }
            }
        });

        nextButton = findViewById(R.id.nextBtn);
        nextButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

            }
        });

        previousButton = findViewById(R.id.previousBtn);
        previousButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                
            }
        });
        // Get ID from content_main
        songsListView = (ListView) findViewById(R.id.SongsListView);
        fetchSongsFromWeb();
        //====== Get url where our musics stored or you can get any mp3 on internet, grab it address.

        //====== Fire ups the streamer ==========



    }

    //===================== Method streaming Music in url ==========================================
    private void startStreamingServices (String url) {
        /**===== FIRE UP THE SERVICES ============================================ */
        /**== 1st : Create AN INTENT */
        Intent i = new Intent(this, PlayerService.class);

        /**=== In playerservices because we get the informs from by using
         * getStringExtra so we'll use the putExtra to add the url in*/
        i.putExtra("url",url);

        // Give an action to foreground inorder to not to crash when the startforeground action != null
        Log.i("Start Streaming","Start Music successfully");
        startService(i);
        //================ BIND SERVICES AFTER ITS PERFORMING THE TASK or NON of unbind will work ==
        bindService(i, mServiceConnection, Context.BIND_AUTO_CREATE);
    }




    @Override
    protected void onStop() {
        super.onStop();
        // If app close unbind the services, that mean button in app after minimize will not work properly
         // Because the service is been unbind
        if (mServiceBound) {
            unbindService(mServiceConnection);
            mServiceBound = false;
        }
    }

    /**==== Method call in an activities whenever it appears interview*/
    @Override
    protected void onResume() {
        super.onResume();
        /**==== REGISTER TO RECEIVER THE BROADCAST MESSENGER WITH THE MESSENGER NAME changePlayButton =====
         * When receive the intent name changePlayButton, its going to send it to mMesseageReceiver */
        LocalBroadcastManager.getInstance(this).registerReceiver(mMessageReciever,new IntentFilter("changePlayButton"));
    }

    /**==== Method call when our activities disappears when they been sent*/
    @Override
    protected void onPause() {
        super.onPause();
        /**===== ACTIVITIES NO LONGER RUNNING, SO UNREGISTERED IT*/
        LocalBroadcastManager.getInstance(this).unregisterReceiver(mMessageReciever);
    }

    /**========= FLIP BUTTON PLAY AND PAUSE ======================================================*/
    public static void flipPlayPauseButton (boolean isPlaying) {
        /**=== Check music if is playing , set the icon to the pause icon */
        if (isPlaying) {
            playPauseButton.setImageResource(android.R.drawable.ic_media_pause);
        } else {
            playPauseButton.setImageResource(android.R.drawable.ic_media_play);
        }
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    /**========== How call to website inside java ============*/
    private void fetchSongsFromWeb () {
        // Create new BG thread
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                // ======== Run URL CONNECTION in BACKGROUND
                // Run webcall
                HttpURLConnection urlConnection = null;
                //Store result comback from file
                InputStream inputStream = null;

                // If adress doesnt exist or device lost connect, may failed
                try {
                    // URL connection code, make sure adress is correct
                    URL url = new URL("https://selflearningapp.000webhostapp.com/musics_app/get_musics.php");

                    // Set up URL connection
                    urlConnection = (HttpURLConnection) url.openConnection();

                    // Request methods, GET data from server, uploading sthing use POST, can have both if need
                    urlConnection.setRequestMethod("GET");

                    // Check if response to debug
                    int statusCode = urlConnection.getResponseCode();
                    Log.d("CONNECTED","CONNECTED SUCCESFULLY" + " " + statusCode);

                    // 200 is HTTP connection is OK
                    if (statusCode == 200) {
                        // Get all data
                        inputStream = new BufferedInputStream((urlConnection.getInputStream()));
                        // Convert into string
                        String responses = convertInputStreamToString(inputStream);
                        Log.d("GOT SONG",responses);
                        parseIntoSongs (responses);
                    }
                } catch (Exception e) {
                    e.printStackTrace();
                }
                // If try work, then loop will go to final
                    // Final always run no matter what happend, ( Create for drop connection )
                finally {
                    if (urlConnection != null) {
                        urlConnection.disconnect();
                    }
                }
            }
        });
        thread.start();
    }

    private String convertInputStreamToString(InputStream inputStream) throws IOException {
        // Reader to grab string
        BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream));
            // Read anything line by line and add to result
        String line = "" ;
        String result = "";

        while ((line = bufferedReader.readLine()) != null) {
            result += line;
        }

        if (inputStream != null) {
            inputStream.close();
        }

        return result;
    }

    // Method parseIntoSong
    private void parseIntoSongs(String data) {
        // The data is seperated by *, seperate string in java automatically create a string array
        String[] dataArray = data.split("\\*"); // add 2 back slash to tell program split * char

        // Create counter
        int i = 0;
        for (i = 0 ; i < dataArray.length; i++){
            String[] songArray = dataArray[i].split(",");
            Song song = new Song(songArray[0], songArray[1]);
            songs.add(song);

        }

        for (i = 0; i < songs.size();i++){
            String songList;
            songList = songs.get(i).getTitle();
            Log.i("GOT SONG", songList);
        }
        populateSongsListView();
    }
    // Populate must be in Main UI thread
    private void populateSongsListView() {
        runOnUiThread(new Runnable() {
            @Override
            public void run() {
                // if only "this" it will references the run() method and get error
                SongListAdapter adapter = new SongListAdapter(MainActivity.this,songs);
                // Set adapter for listView
                songsListView.setAdapter(adapter);
                //Create an click on listener
                songsListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                    @Override
                    public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                        //Decide what song user has clicked on
                        Song song = songs.get(position);
                        //URL where it located
                        String songAddress = "https://selflearningapp.000webhostapp.com/musics_app/" + song.getTitle();
                        // Start streaming service
                        startStreamingServices(songAddress);
                        currentSongPlayed(song.getId());
                    }
                });
            }
        });
    }

    private void currentSongPlayed(int songID){
        Runnable target;
        Thread thread = new Thread(new Runnable() {
            @Override
            public void run() {
                InputStream inputStream = null;
                HttpURLConnection urlConnection = null;

                try {
                    URL url = new URL("https://selflearningapp.000webhostapp.com/musics_app/");
                }catch (Exception e){
                    e.printStackTrace();
                }
            }
        });
    }
}