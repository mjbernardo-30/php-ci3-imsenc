<?php
class ValidationErrorMessage {
	const VLD0001 = 'Email Address does not exist.';
	const VLD0002 = 'Invalid Email Address.';
	const VLD0003 = 'Incorrect Password.';
	const VLD0004 = 'Your account is either disabled or locked out.';
	const VLD0005 = 'Your account is logged in to another device. Please seek resetting your account to the Adminstrator or wait for atleast 20 mins to login again.';
	const VLD0006 = 'Email Address already exist.';
	const VLD0007 = "User Id can't be retrieved.";
	const VLD0008 = "New Password and Confirm Password does not match.";
	const VLD0009 = "User account is disabled.";
	const VLD0010 = "Cannot reset own account.";
	const VLD0011 = "Cannot re-do same operation.";
	const VLD0012 = "Your age is not eligible to register.";
	const VLD0013 = "Your information has already been registered.";
	const VLD0014 = "Mobile Number already exist.";
	const VLD0015 = "Email Address already exist.";
	const VLD0016 = "Government ID is mandatory.";
	const VLD0017 = "School ID is mandatory.";
	const VLD0018 = "File name already exist.";
	const VLD0019 = "Reference ID not available.";
	const VLD0020 = "Cannot reject as reference already rejected.";
	const VLD0021 = "Cannot reject as reference already approved.";
	const VLD0022 = "Registration Entry Link already exist.";
}

class OperationalErrorMessage {
	const OPS0001 = 'An error has occured when updating the entry.';
	const OPS0002 = 'Failed to login. Please try again later.';
	const OPS0003 = 'An error has occured when inserting the entry.';
	const OPS0004 = 'An error has occured when saving the registration.';
}
?>