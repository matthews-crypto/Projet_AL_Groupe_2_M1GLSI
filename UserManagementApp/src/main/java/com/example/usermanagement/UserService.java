package com.example.usermanagement.services;

import com.example.usermanagement.models.User;
import org.apache.http.client.methods.*;
import org.apache.http.entity.StringEntity;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;
import org.apache.http.util.EntityUtils;
import com.fasterxml.jackson.databind.ObjectMapper;

import java.io.IOException;

public class UserService {
    private static final String BASE_URL = "http://localhost:1323/restricted";
    private final String token;

    public UserService(String token) {
        this.token = token;
    }

    public User[] listUsers() {
        CloseableHttpClient client = HttpClients.createDefault();
        HttpGet request = new HttpGet(BASE_URL + "/users");
        request.addHeader("Authorization", "Bearer " + token);

        try (CloseableHttpResponse response = client.execute(request)) {
            if (response.getStatusLine().getStatusCode() == 200) {
                String json = EntityUtils.toString(response.getEntity());
                ObjectMapper mapper = new ObjectMapper();
                return mapper.readValue(json, User[].class);
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
        return new User[0];
    }

    public void addUser(User user) {
        CloseableHttpClient client = HttpClients.createDefault();
        HttpPost request = new HttpPost(BASE_URL + "/users");
        request.addHeader("Authorization", "Bearer " + token);
        request.addHeader("Content-Type", "application/json");

        try {
            ObjectMapper mapper = new ObjectMapper();
            String json = mapper.writeValueAsString(user);
            request.setEntity(new StringEntity(json));

            try (CloseableHttpResponse response = client.execute(request)) {
                if (response.getStatusLine().getStatusCode() == 201) {
                    System.out.println("User added successfully.");
                } else {
                    System.out.println("Failed to add user.");
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void updateUser(User user) {
        CloseableHttpClient client = HttpClients.createDefault();
        HttpPut request = new HttpPut(BASE_URL + "/users/" + user.getId());
        request.addHeader("Authorization", "Bearer " + token);
        request.addHeader("Content-Type", "application/json");

        try {
            ObjectMapper mapper = new ObjectMapper();
            String json = mapper.writeValueAsString(user);
            request.setEntity(new StringEntity(json));

            try (CloseableHttpResponse response = client.execute(request)) {
                if (response.getStatusLine().getStatusCode() == 200) {
                    System.out.println("User updated successfully.");
                } else {
                    System.out.println("Failed to update user.");
                }
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    public void deleteUser(int id) {
        CloseableHttpClient client = HttpClients.createDefault();
        HttpDelete request = new HttpDelete(BASE_URL + "/users/" + id);
        request.addHeader("Authorization", "Bearer " + token);

        try (CloseableHttpResponse response = client.execute(request)) {
            if (response.getStatusLine().getStatusCode() == 204) {
                System.out.println("User deleted successfully.");
            } else {
                System.out.println("Failed to delete user.");
            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
