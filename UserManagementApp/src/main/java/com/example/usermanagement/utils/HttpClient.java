package com.example.usermanagement.utils;

import org.apache.http.client.methods.CloseableHttpResponse;
import org.apache.http.client.methods.HttpUriRequest;
import org.apache.http.impl.client.CloseableHttpClient;
import org.apache.http.impl.client.HttpClients;

import java.io.IOException;

public class HttpClient {
    public static CloseableHttpResponse execute(HttpUriRequest request) throws IOException {
        CloseableHttpClient client = HttpClients.createDefault();
        return client.execute(request);
    }
}