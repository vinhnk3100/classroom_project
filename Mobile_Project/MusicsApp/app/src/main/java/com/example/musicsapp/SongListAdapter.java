package com.example.musicsapp;

import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import java.util.List;

public class SongListAdapter extends BaseAdapter {

    //Adapter to populate list view, need a variable to reference the activity if using this list adapter
    private Activity activity;
    private List<Song> songs;

    // Layout inflater: That grab the xml and draw it
    private static LayoutInflater inflater = null;

    // Instantiated inside constructor
    public SongListAdapter (Activity activity, List<Song> songs){
        this.activity = activity;
        this.songs = songs;
        inflater = (LayoutInflater) activity.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    // Put some default method to adapter
    public int getCount() {
        // return how many row to create the list
        // Return song size as many row as songs
        return songs.size();
    }

    // Create method getitem
    @Override
    public Object getItem(int position) {
        // Return current position in list
        return position;
    }

    //Access the ID from the item
    @Override
    public long getItemId(int position) {
        return position;
    }

    //Main method use to create row, populate data, turn into ListView
    public View getView(int position, View convertView, ViewGroup parent) {
        //If self dont parse into convertView will be null
        View view = convertView;
        // Check convertView is null, mean the layout for user to load the song name
        if (convertView == null) {
            //v = inflater.inflate(R.layout.songlistview_row, null);

            // Issues Sizing of yourself, size specify wont come out, will get error
            view = inflater.inflate(R.layout.songlistview_row, parent, false);
        }

        // Grab text view to put name of songs
        TextView title = (TextView) view.findViewById(R.id.songsRowTextView);
        Song song = songs.get(position);

        title.setText(song.getTitle());
        return view;
    }
}
