package com.tsi.plantdiagnosissystem.ui.forgotpassword;

import android.content.Context;
import android.content.Intent;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.fragment.app.Fragment;
import androidx.navigation.NavArgument;
import androidx.navigation.fragment.NavHostFragment;

import com.tsi.plantdiagnosissystem.R;
import com.tsi.plantdiagnosissystem.controller.AuthenticationController;
import com.tsi.plantdiagnosissystem.controller.Utils;
import com.tsi.plantdiagnosissystem.data.model.User;

public class RecoverPasswordFragment extends Fragment {

    EditText emailEditText;
    Button getVerificationCodeButton;
    Context context;
    User user;

    @Override
    public View onCreateView(
            LayoutInflater inflater, ViewGroup container,
            Bundle savedInstanceState
    ) {
        // Inflate the layout for this fragment
        return inflater.inflate(R.layout.fragment_recover_password, container, false);
    }

    public void onViewCreated(@NonNull View view, Bundle savedInstanceState) {
        super.onViewCreated(view, savedInstanceState);

        context = getContext();

        emailEditText = view.findViewById(R.id.emailEditText);
        getVerificationCodeButton = view.findViewById(R.id.getVerificationCodeButton);

        getVerificationCodeButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                user = new User();
                user.setUsername(emailEditText.getText().toString());
                AuthenticationController.recoverPassword(user.getUsername());

                //call alertDialog
                isValidOtpDialog();
            }
        });

//        view.findViewById(R.id.button_first).setOnClickListener(new View.OnClickListener() {
//            @Override
//            public void onClick(View view) {
//                NavHostFragment.findNavController(RecoverPasswordFragment.this)
//                        .navigate(R.id.action_FirstFragment_to_SecondFragment);
//            }
//        });
    }

    private void isValidOtpDialog() {

        Button buttonConfirm;
        final EditText editTextConfirmOtp;
        //Creating a LayoutInflater object for the dialog box
        LayoutInflater li = LayoutInflater.from(context);
        //Creating a view to get the dialog box
        View confirmDialog = li.inflate(R.layout.dialog_verify_otp, null);

        //Initializing confirm button fo dialog box and editText of dialog box
        buttonConfirm = (Button) confirmDialog.findViewById(R.id.buttonConfirm);
        editTextConfirmOtp = (EditText) confirmDialog.findViewById(R.id.editTextOtp);

        //Creating an alertDialog builder
        AlertDialog.Builder alert = new AlertDialog.Builder(context);

        //Adding our dialog box to the view of alert dialog
        alert.setView(confirmDialog);

        //Creating an alert dialog
        final AlertDialog alertDialog = alert.create();


        //adding title
        alert.setTitle("OTP Verification!");

        //Displaying the alert dialog
        alertDialog.show();

        //On the click of the confirm button from alert dialog
        buttonConfirm.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                //Hiding the alert dialog
                alertDialog.dismiss();

                //Getting the user entered otp from editText
                final String otp = editTextConfirmOtp.getText().toString().trim();
                user.setOtp(otp);
                //Creating an string request
                User userOtpMatched = AuthenticationController.isValidOtp(user);

                if (userOtpMatched != null) {
                    Toast.makeText(context, "Otp Matched!", Toast.LENGTH_LONG).show();
                    AuthenticationController.saveLogInInfo(context, userOtpMatched);

                    NavHostFragment.findNavController(RecoverPasswordFragment.this)
                    .getGraph().findNode(R.id.action_FirstFragment_to_SecondFragment)
                            .addArgument("user", new NavArgument.Builder().setDefaultValue(user).build());

//                    NavHostFragment.findNavController(RecoverPasswordFragment.this)
//                            .navigate(R.id.action_FirstFragment_to_SecondFragment);
                } else {
                    isValidOtpDialog();
                }
            }
        });
    }
}
