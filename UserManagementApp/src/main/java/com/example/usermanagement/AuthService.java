package com.example.usermanagement.services;

import com.example.usermanagement.utils.HttpClient;
import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.util.EntityUtils;
import java.io.IOException;

public class AuthService {
    private static final String LOGIN_URL = "http://localhost:1323/login";

    public String login(String username, String password) {
        CloseableHttpClient client = HttpClients.createDefault();
        String requestUrl = String.format("%s?username=%s&password=%s", LOGIN_URL, username, password);
        HttpGet request = new HttpGet(requestUrl);

        try (CloseableHttpResponse response = client.execute(request)) {
            if (response.getStatusLine().getStatusCode() == 200) {
                String json = EntityUtils.toString(response.getEntity());
                // Parse JSON to extract token
                // For simplicity, we'll assume the response is: {"token": "your_token_here"}
                String token = json.split(":")[1].replace("\"", "").replace("}", "").trim();
                return token;
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return null;
    }
}
