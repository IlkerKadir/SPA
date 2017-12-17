package com.example.ahmetbesiktepe.myspa;

/**
 * Created by Ahmet Besiktepe on 06/12/2017.
 */
import android.content.Context;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;
import android.content.ContentValues;
import android.database.Cursor;

public class DatabaseHelper extends SQLiteOpenHelper {
    private static final String DB_NAME = "users.db";
    private static final String TABLE_NAME = "t001";
    private static final int DB_VERSION = 1;

    private SQLiteDatabase db;

    /**
     * Constructor
     *
     * @param context application context
     */
    public DatabaseHelper(Context context) {
        super(context, DB_NAME, null, DB_VERSION);
        db = this.getWritableDatabase();
    }

    /**
     * Generic method executes SQL query that creates the table.
     *
     * @param db database itself
     */
    @Override
    public void onCreate(SQLiteDatabase db) {
        db.execSQL("CREATE TABLE " + TABLE_NAME + " ("
                + "ID INTEGER PRIMARY KEY AUTOINCREMENT,"
                + "username TEXT UNIQUE,"
                + "ctext TEXT NOT NULL"
                + ");");
    }

    /**
     * Generic onUpgrade method of the SQLite Database
     *
     * @param db database itself
     * @param oldVersion old version number
     * @param newVersion new version number
     */
    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_NAME);
        onCreate(db);
    }

    /**
     * This method checks if a username exists in the database
     *
     * @param username
     * @return true if username exists. False otherwise
     */
    public boolean isUserExists(String username) {
        String query = "Select * from " + TABLE_NAME + " where username='" + username +"'";
        Cursor cursor = db.rawQuery(query, null);
        if (cursor.getCount() <= 0) {
            cursor.close();
            return false;
        }
        cursor.close();
        return true;
    }


    /**
     * This method adds a new user to the database
     *
     * @param username
     * @param ctext ctext belongs to the user
     */
    public void addUser(String username, String ctext) {
        ContentValues values = new ContentValues();
        values.put("username", username);
        values.put("ctext", ctext);

        db.insert(TABLE_NAME, null, values);
    }


    /**
     * This method returns ctext of a specific user.
     * Returns "ERROR" if username does not exist in the database
     *
     * @param username
     * @return ctext belongs to the user
     */
    public String getCtext(String username) {
        String selectQuery = "SELECT ctext FROM "+ TABLE_NAME + " WHERE username=?";
        String ctext = "ERROR";
        Cursor c = db.rawQuery(selectQuery, new String[] { username });
        if (c.moveToFirst()) {
            ctext = c.getString(c.getColumnIndex("ctext"));
        }
        c.close();
        return ctext;
    }

}