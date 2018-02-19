package fr.insa.hdtran.ctfthc;

import android.graphics.Color;
import android.os.AsyncTask;
import android.os.CountDownTimer;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.URL;
import java.net.URLConnection;

public class MainActivity extends AppCompatActivity {
    private Button mStartButton;
    private Button mStopButton;
    private Button mChangeFGButton;
    private Button mChangeBGButton;
    private TextView mMsg;
    private TextView mTimeRemaining;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        mStartButton = (Button) findViewById(R.id.startButton);
        mStopButton = (Button) findViewById(R.id.stopButton);
        mChangeBGButton = (Button) findViewById(R.id.changeBGButton);
        mChangeFGButton =  (Button) findViewById(R.id.changeFGButton);
        mMsg = (TextView) findViewById(R.id.msg);
        mMsg.setText("");
        mMsg.setTextColor(Color.CYAN);
        mTimeRemaining = (TextView) findViewById(R.id.timeRemaining);

        mStartButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMsg.setText("START command is sent");
                try{
                    new SendCommandTask().execute(new URL("http://192.168.73.140/action.php?cmd=START"));
                } catch (Exception e){
                    e.printStackTrace();
                }

            }
        });

        mChangeFGButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMsg.setText("Change ForeGround command is sent");
                try{
                    new SendCommandTask().execute(new URL("http://192.168.73.140/action.php?cmd=CHANGE_FGCOLOR"));
                } catch (Exception e){
                    e.printStackTrace();
                }
            }
        });
        mChangeBGButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMsg.setText("Change BackGround command is sent");
                try{
                    new SendCommandTask().execute(new URL("http://192.168.73.140/action.php?cmd=CHANGE_BGCOLOR"));
                } catch (Exception e){
                    e.printStackTrace();
                }
            }
        });
        // crashed button
        mStopButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                mMsg.setText("STOP command is sent");
                try{
                    new SendCommandTask().execute(new URL("http://192.168.73.140/action.php?cmd=STOP"));
                } catch (Exception e){
                    e.printStackTrace();
                }
            }
        });


        try {
            new DemandTimeTask(new AsyncResponse(){
                public void processFinish(long time){
                    // read.php?file=compteur
                    new CountDownTimer(time, 1000){
                        public void onTick(long millisUntilFinished) {
                            //TextView mTimeRemain = (TextView) findViewById(R.id.timeRemaining);
                            String time = TimeTranform(millisUntilFinished/1000);
                            mTimeRemaining.setTextColor(Color.RED);
                            mTimeRemaining.setText("Time remaining: " + time);
                        }

                        public void onFinish() {
                            //TextView mTimeRemain = (TextView) findViewById(R.id.timeRemaining);
                            mTimeRemaining.setText("Game Over!");
                        }
                    }.start();
                }
            }).execute(new URL("http://192.168.73.140/read.php?file=compteur"));
        } catch (Exception e){
            e.printStackTrace();
        }

    }
    public  String TimeTranform(long time){
        long h = time/60;
        long sec = time % 60;
        String hS = Long.toString(h);
        String secS = Long.toString(sec);
        if (hS.length() == 1){
            hS = "0" + hS;
        }
        if  (secS.length() == 1){
            secS = "0" + secS;
        }
        return hS + ":" + secS;
    }
    private interface AsyncResponse{
        void processFinish(long time);
    }

    private class SendCommandTask extends AsyncTask<URL, Integer, String> {
        protected String doInBackground(URL... urls){
            int count = urls.length;
            for(int i = 0; i < count; i++){
                // Do something here
                try{
                    URLConnection conn = urls[i].openConnection();
                    BufferedReader in = new BufferedReader(
                            new InputStreamReader(
                                    conn.getInputStream()));
                    String line;
                    String response = "";
                    while ((line = in.readLine()) != null){
                        response += line + "\n";
                    }
                    in.close();
                    return  response;

                } catch ( Exception e){
                    e.printStackTrace();
                    return "Error occur during send command" + e.toString();

                }


            }
            return "Hello, You should not be here";
        }

        protected void onPostExecute(String result){
            TextView mMsg = (TextView) findViewById(R.id.msg);
            try {
                JSONObject jObject = new JSONObject(result);
                boolean aJsonBoolean = jObject.getBoolean("success");
                String msg = jObject.getString("msg");
                if (aJsonBoolean){
                    mMsg.setText("SUCCESS : " + msg);
                }else{
                    mMsg.setText("Failed : " + msg);
                }



            } catch (JSONException e) {
                e.printStackTrace();
            }

        }
    }




    private class DemandTimeTask extends AsyncTask<URL, Integer, String> {
        private AsyncResponse delegate = null;

        public DemandTimeTask(AsyncResponse delegate){
            this.delegate = delegate;
        }


        protected String doInBackground(URL... urls){
            int count = urls.length;
            for(int i = 0; i < count; i++){
                // Do something here
                try{
                    URLConnection conn = urls[i].openConnection();
                    BufferedReader in = new BufferedReader(
                            new InputStreamReader(
                                    conn.getInputStream()));
                    String line;
                    String response = "";
                    while ((line = in.readLine()) != null){
                        response += line;
                    }
                    in.close();
                    return  response;

                } catch ( Exception e){
                    e.printStackTrace();
                    return "Error occur during send command" + e.toString();

                }


            }
            return "Hello, You should not be here";
        }

        protected void onPostExecute(String result){
            String[] time = result.split(":");
            long minute = Long.parseLong(time[0]);
            long second = Long.parseLong(time[1]);
            long millisec = (minute*60 + second)*1000;
            delegate.processFinish(millisec);

        }
    }
}
