package com.example.musicsapp;

// Get song from input at Mainactivity =============================================================
public class Song {
    int Id;
    String title;

    //Because value come from php file is text, so Id is string
    public Song (String Id, String title) {
        // Catching not a number error
        try {
            this.Id = Integer.parseInt(Id);
        } catch (Exception e) {
            this.Id = 0;
        }
        this.title = title;
    }

    // Create method to get out values
    public int getId () {
        return Id;
    }

    public String getTitle() {
        return title;
    }
}
