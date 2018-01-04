package com.example.ahmetbesiktepe.myspa;


import android.content.Context;
import android.os.AsyncTask;
import android.widget.Toast;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

public class OnlineDatabase2 extends AsyncTask<String,Void,String> {

    Context ctx;
    public OnlineDatabase2(Context ctx) {
        this.ctx=ctx;
    }
    @Override
    protected String doInBackground(String... params) {
        String myDatabase = "http://172.20.128.16:8080/spa/dummyhelper.php";
        String method= params[0];
        if(method.equals("onetime")){
            String username = params[1];
            String bank_id = params[2];
            String finalCode = params[3];
            try {
                URL url = new URL(myDatabase);
                HttpURLConnection myURLConnection =(HttpURLConnection) url.openConnection();
                myURLConnection.setRequestMethod("POST");
                myURLConnection.setDoOutput(true);
                OutputStream os = myURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(os,"UTF-8"));
                String data = URLEncoder.encode("username","UTF-8") + "=" +URLEncoder.encode(username,"UTF-8") + "&" +

                        URLEncoder.encode("bank_id","UTF-8") + "=" +URLEncoder.encode(bank_id,"UTF-8")+ "&" +
                        URLEncoder.encode("finalCode","UTF-8") + "=" +URLEncoder.encode(finalCode,"UTF-8")  ;

                bufferedWriter.write(data);
                bufferedWriter.flush();
                bufferedWriter.close();
                os.close();
                InputStream IS = myURLConnection.getInputStream();
                IS.close();
                return "";

            } catch (MalformedURLException e) {
                e.printStackTrace();
            } catch (IOException e) {
                e.printStackTrace();
            }

        }

        return null;
    }
    @Override
    protected void onPreExecute() {
        super.onPreExecute();
    }

    @Override
    protected void onPostExecute(String result) {
        result = "";
        Toast.makeText(ctx,result,Toast.LENGTH_LONG).show();

    }

    @Override
    protected void onProgressUpdate(Void... values) {
        super.onProgressUpdate(values);
    }
}



