package com.example.ahmetbesiktepe.myspa;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import javax.crypto.Mac;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

public class OneTimeCode extends AppCompatActivity {
EditText e_code;
String code,Mackey,finalCode,username;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_time_code);
       Bundle bundle = getIntent().getExtras();
        Mackey = bundle.getString("Mackey");
        username = bundle.getString("username");
        e_code = (EditText) findViewById(R.id.otp);
    }


 private String generateMAC(String recievedCode, String mackey)throws Exception{
     byte[] bytes = mackey.getBytes();//Base64.decode(mackey,Base64.DEFAULT);
     SecretKey originalKey = new SecretKeySpec(bytes, 0, bytes.length, "HmacMD5");
     Mac mac = Mac.getInstance(originalKey.getAlgorithm());
     mac.init(originalKey);
     byte[] byte1 = recievedCode.getBytes("ISO-8859-1");
     byte[] digest = mac.doFinal(byte1);
     String output = "";
     for (byte b : digest) {
         output+= String.format("%02x", b);
     }

     //byte[] hexBytes = new Hex().encode(digest);
     /*BigInteger hash =new BigInteger(1, digest);
     String output = hash.toString(16);
     if ((output.length() % 2) != 0) {
output = "0" + output;
     }
     String output = Base64.encodeToString(digest, Base64.DEFAULT).trim();
*/

return output;

 }

public void sendCode(View view) throws Exception{
    code = e_code.getText().toString();
    finalCode = generateMAC(code,Mackey);
  //  String method = "OneTimeCode";
    Toast.makeText(this,finalCode,Toast.LENGTH_LONG).show();
   // OnlineDatabaseLogin backTask = new OnlineDatabaseLogin(this);
   // backTask.execute(method,username,Mackey,finalCode);
    finish();
}


}
