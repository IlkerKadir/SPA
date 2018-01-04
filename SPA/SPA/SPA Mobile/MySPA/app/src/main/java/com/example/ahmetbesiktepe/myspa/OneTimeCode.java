package com.example.ahmetbesiktepe.myspa;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Base64;
import android.view.View;
import android.widget.EditText;

import javax.crypto.Mac;
import javax.crypto.SecretKey;
import javax.crypto.spec.SecretKeySpec;

public class OneTimeCode extends AppCompatActivity  {

String otp,mac_key,finalCode,bank_id,username;
byte[] finalCodeByte;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_one_time_code);

      Bundle bundle = getIntent().getExtras();
        mac_key = bundle.getString("mac_key");
        otp = bundle.getString("otp");
        bank_id = bundle.getString("bank_id");
        username = bundle.getString("username");
        EditText textView = (EditText) findViewById(R.id.otpV);
        textView.setText(otp);

    }



 private byte[] generateMAC(String recievedCode, String mackey)throws Exception{
     byte[] bytes = mackey.getBytes();//Base64.decode(mackey,Base64.DEFAULT);
     SecretKey originalKey = new SecretKeySpec(bytes, 0, bytes.length, "HmacMD5");
     Mac mac = Mac.getInstance(originalKey.getAlgorithm());
     mac.init(originalKey);
     byte[] byte1 = recievedCode.getBytes("ISO-8859-1");
     byte[] digest = mac.doFinal(byte1);
     //String output = "";
    /* for (byte b : digest) {
         output+= String.format("%02x", b);
     }
*/
     //byte[] hexBytes = new Hex().encode(digest);
     /*BigInteger hash =new BigInteger(1, digest);
     String output = hash.toString(16);
     if ((output.length() % 2) != 0) {
output = "0" + output;
     }
     String output = Base64.encodeToString(digest, Base64.DEFAULT).trim();
*/

return digest;

 }

public void generateCode(View view) throws Exception{
    finalCodeByte = generateMAC(otp,mac_key);
    byte[] transfer = new byte[6];

    for(int i = 0;i<6;i++){
        transfer[i] = finalCodeByte[i];
    }
    finalCode = Base64.encodeToString(transfer, Base64.DEFAULT).trim();

    // for (byte b : transfer) {
     //   finalCode+= String.format("%02x", b);
    //}
    String method = "onetime";
    OnlineDatabase2 backTask = new OnlineDatabase2(this);
    backTask.execute(method,username,bank_id,finalCode);
    Intent intent = new Intent(this,showCode.class);
    Bundle bundle = new Bundle();
    bundle.putString("finalCode",finalCode);
    intent.putExtras(bundle);
    startActivity(intent);
}


}
