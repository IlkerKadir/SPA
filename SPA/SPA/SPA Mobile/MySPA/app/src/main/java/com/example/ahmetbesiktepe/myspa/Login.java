package com.example.ahmetbesiktepe.myspa;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.view.View;
import android.widget.EditText;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

import javax.crypto.Cipher;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

public class Login extends AppCompatActivity {
EditText e_username,e_password;
String username,password,trialkey;
DatabaseHelper db;
Cipher cipher;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        e_username = (EditText) findViewById(R.id.username);
        e_password = (EditText) findViewById(R.id.password);
        db = new DatabaseHelper(this.getApplicationContext());
    }
    private SecretKey hashPassword(String password,String salt){
        SecretKey hashedKey = null;
        try{
            MessageDigest md = MessageDigest.getInstance("MD5");
            md.update(salt.getBytes("UTF-8"));
            byte[] bytes = md.digest(password.getBytes("UTF-8"));
            hashedKey = new SecretKeySpec(bytes, 0, bytes.length, "AES");
        }catch
                (NoSuchAlgorithmException e){
            e.printStackTrace();
        } catch (UnsupportedEncodingException e) {
            e.printStackTrace();
        }
        return hashedKey;
    }
    private String getMacKey(SecretKey secretkey,String ctext) throws Exception{
        byte[] encryptedTextByte = Base64.decode(ctext,Base64.DEFAULT);
        cipher.init(Cipher.DECRYPT_MODE, secretkey);
        byte[] decryptedByte = cipher.doFinal(encryptedTextByte);
        String decryptedText = new String(decryptedByte);
        return decryptedText;
    }


    public void loguser(View view) throws Exception{
    username = e_username.getText().toString();
    password = e_password.getText().toString();
    String ctext = db.getCtext(username);
    SecretKey hashKey =hashPassword(password,"1234");
    cipher = Cipher.getInstance("AES");
    trialkey = getMacKey(hashKey,ctext);
        Intent intent = new Intent(this,OneTimeCode.class);
         Bundle bundle = new Bundle();
        bundle.putString("Mackey",trialkey);
        bundle.putString("username",username);
        intent.putExtras(bundle);
         startActivity(intent);

    }

}
