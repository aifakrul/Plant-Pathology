package com.tsi.plantdiagnosissystem.data;

import com.tsi.plantdiagnosissystem.controller.AuthenticationController;
import com.tsi.plantdiagnosissystem.data.model.User;

import java.io.IOException;

/**
 * Class that handles authentication w/ login credentials and retrieves user information.
 */
public class LoginDataSource {

    public Result<User> login(String username, String password) {

        try {
            // TODO: handle loggedInUser authentication
//            User fakeUser =
//                    new User(
//                            java.util.UUID.randomUUID().toString(),
//                            "Jane Doe");
//            return new Result.Success<>(fakeUser);
            User loggedInUser = AuthenticationController.logInUser(username, password);
            return new Result.Success<>(loggedInUser);
        } catch (Exception e) {
            return new Result.Error(new IOException("Error logging in", e));
        }
    }

    public void logout() {
        // TODO: revoke authentication
    }
}
