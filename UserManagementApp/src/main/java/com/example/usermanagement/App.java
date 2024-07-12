package com.example.usermanagement;

import com.example.usermanagement.services.AuthService;
import com.example.usermanagement.services.UserService;
import com.example.usermanagement.models.User;

import java.util.Scanner;

public class App {
    public static void main(String[] args) {
        Scanner scanner = new Scanner(System.in);

        System.out.println("Enter your username:");
        String username = scanner.nextLine();

        System.out.println("Enter your password:");
        String password = scanner.nextLine();

        AuthService authService = new AuthService();
        String token = authService.login(username, password);

        if (token != null) {
            System.out.println("Login successful. Token: " + token);

            UserService userService = new UserService(token);

            while (true) {
                System.out.println("Choose an action:");
                System.out.println("1: List users");
                System.out.println("2: Add user");
                System.out.println("3: Update user");
                System.out.println("4: Delete user");
                System.out.println("5: Exit");

                int choice = scanner.nextInt();
                scanner.nextLine();  // Consume newline

                switch (choice) {
                    case 1:
                        listUsers(userService);
                        break;
                    case 2:
                        addUser(scanner, userService);
                        break;
                    case 3:
                        updateUser(scanner, userService);
                        break;
                    case 4:
                        deleteUser(scanner, userService);
                        break;
                    case 5:
                        System.exit(0);
                        break;
                    default:
                        System.out.println("Invalid choice, please try again.");
                }
            }
        } else {
            System.out.println("Login failed. Invalid credentials.");
        }
    }

    private static void listUsers(UserService userService) {
        User[] users = userService.listUsers();
        for (User user : users) {
            System.out.println("ID: " + user.getId() + ", Username: " + user.getUsername());
        }
    }

    private static void addUser(Scanner scanner, UserService userService) {
        System.out.println("Enter new user's username:");
        String username = scanner.nextLine();

        System.out.println("Enter new user's password:");
        String password = scanner.nextLine();

        User newUser = new User();
        newUser.setUsername(username);
        newUser.setPassword(password);

        userService.addUser(newUser);
        System.out.println("User added successfully.");
    }

    private static void updateUser(Scanner scanner, UserService userService) {
        System.out.println("Enter the ID of the user to update:");
        int id = scanner.nextInt();
        scanner.nextLine();  // Consume newline

        System.out.println("Enter new username:");
        String username = scanner.nextLine();

        System.out.println("Enter new password:");
        String password = scanner.nextLine();

        User updatedUser = new User();
        updatedUser.setId(id);
        updatedUser.setUsername(username);
        updatedUser.setPassword(password);

        userService.updateUser(updatedUser);
        System.out.println("User updated successfully.");
    }

    private static void deleteUser(Scanner scanner, UserService userService) {
        System.out.println("Enter the ID of the user to delete:");
        int id = scanner.nextInt();
        scanner.nextLine();  // Consume newline

        userService.deleteUser(id);
        System.out.println("User deleted successfully.");
    }
}
