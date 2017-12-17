package com.example.ahmetbesiktepe.myspa;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import java.io.UnsupportedEncodingException;
import java.security.MessageDigest;
import java.security.NoSuchAlgorithmException;

import javax.crypto.Cipher;
import javax.crypto.KeyGenerator;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

public class Register extends AppCompatActivity {


    EditText e_password;
    String username,password,k,hashString,ctext,keyRetrieval;
    Cipher cipher;
    DatabaseHelper db;
    String qrResult = "";
    String bankID;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
        e_password = (EditText) findViewById(R.id.password);
        db = new DatabaseHelper(this.getApplicationContext());
        Intent intent = getIntent();
        Bundle bundle = intent.getExtras();
        if (bundle != null) {
            qrResult =(String) bundle.get("qr");
    }

        String spliter = "[,]";
        String[] tokens = qrResult.split(spliter);
        username = tokens[0];
        bankID = tokens[1];

         Toast.makeText(this,username, Toast.LENGTH_LONG).show();
        Toast.makeText(this,bankID, Toast.LENGTH_LONG).show();

    }
  private SecretKey generateKey() {
        SecretKey secretKey = null;
        try {
            KeyGenerator keyGen = KeyGenerator.getInstance("HmacMD5");
            secretKey = keyGen.generateKey();
        } catch (NoSuchAlgorithmException e) {
        }
        return secretKey;
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


    private String createCipherText(SecretKey secretKey,String pTextMacKey)throws Exception{
        String ctext = null;
        byte[] plainTextByte = pTextMacKey.getBytes();
        cipher.init(Cipher.ENCRYPT_MODE, secretKey);
        byte[] encryptedByte = cipher.doFinal(plainTextByte);
        if(encryptedByte != null){
            ctext = Base64.encodeToString(encryptedByte, Base64.DEFAULT);}
        return ctext;
    }
   private String getMacKey(SecretKey secretkey,String ctext) throws Exception{
        byte[] encryptedTextByte = Base64.decode(ctext,Base64.DEFAULT);
        cipher.init(Cipher.DECRYPT_MODE, secretkey);
        byte[] decryptedByte = cipher.doFinal(encryptedTextByte);
        String decryptedText = new String(decryptedByte);
        return decryptedText;
    }
    public void reguser(View view) throws Exception{
        password = e_password.getText().toString();
        SecretKey secretKey = generateKey();
        SecretKey hashKey = hashPassword(password,"1234");
        if(secretKey !=null){
        k = Base64.encodeToString(secretKey.getEncoded(), Base64.DEFAULT);}
        if(hashKey !=null){
            hashString = Base64.encodeToString(hashKey.getEncoded(), Base64.DEFAULT);}
        cipher = Cipher.getInstance("AES");
        ctext = createCipherText(hashKey,k);
        keyRetrieval = getMacKey(hashKey,ctext);
        if (!db.isUserExists(username)) {
            db.addUser(username, ctext);
        }

        String method = "register";
        OnlineDatabase backTask = new OnlineDatabase(this);

        backTask.execute(method,username,k);

        finish();
    }
}



