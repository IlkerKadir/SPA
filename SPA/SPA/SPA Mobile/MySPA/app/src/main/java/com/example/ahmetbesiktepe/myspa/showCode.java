package com.example.ahmetbesiktepe.myspa;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.TextView;

public class showCode extends AppCompatActivity {
String finalCode;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_show_code);
        Bundle bundle = getIntent().getExtras();
        finalCode = bundle.getString("finalCode");
        TextView textView = (TextView) findViewById(R.id.code);
        textView.setText(finalCode);


    }


public void goBack(View view){
        Intent intent = new Intent(this,MainActivity.class);
        startActivity(intent);
        finish();

}

}
