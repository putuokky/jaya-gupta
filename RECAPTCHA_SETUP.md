# reCAPTCHA Integration for Laravel Login

## Setup Instructions

### 1. Get reCAPTCHA Keys
Visit: https://www.google.com/recaptcha/admin/create

- Create a new site
- Choose reCAPTCHA v3
- Add your domain(s)
- Copy the **Site Key** and **Secret Key**

### 2. Add Environment Variables
Update your `.env` file:

```env
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
RECAPTCHA_SCORE_THRESHOLD=0.5
```

The score threshold (0-1) determines what score is acceptable:
- 0.9+ = very likely legitimate
- 0.5 = default threshold
- 0.1 = very likely bot

### 3. Files Modified/Created

#### Created:
1. **`app/Http/Requests/LoginRequest.php`**
   - Custom form request with reCAPTCHA validation
   - Validates email, password, and reCAPTCHA response token

2. **`app/Rules/Recaptcha.php`**
   - Custom validation rule that verifies token with Google API
   - Checks success status and score threshold
   - Handles errors gracefully

3. **`app/Actions/Fortify/AttemptToLogin.php`**
   - Custom login action with integrated validation
   - Handles rate limiting and authentication

#### Modified:
1. **`app/Providers/FortifyServiceProvider.php`**
   - Registered custom login action
   - Added custom validator extension for reCAPTCHA

2. **`config/services.php`**
   - Added reCAPTCHA configuration with environment variables

3. **`resources/views/livewire/auth/login.blade.php`**
   - Integrated Google reCAPTCHA v3 script
   - Added hidden input field for token
   - Form intercepts submit to get token before submission

## How It Works

1. **User visits login page** → reCAPTCHA v3 script loads silently
2. **User clicks "Log in"** → JavaScript intercepts the form submission
3. **grecaptcha.execute()** → Gets a token from Google (background, invisible to user)
4. **Token stored** → Hidden input field is populated with token
5. **Form submits** → Token is sent to server with credentials
6. **Server validates**:
   - Email and password format
   - reCAPTCHA token verification with Google API
   - Token score check (if score < threshold, reject)
7. **Success/Failure** → User is authenticated or shown error

## Error Handling

If reCAPTCHA validation fails, users see:
- "reCAPTCHA verification failed. Please try again."
- Or configuration error message if keys are missing

Validation errors appear in the `@error` section of the login form.

## Testing

You can test the implementation:

```bash
# Ensure environment variables are set
php artisan config:cache
php artisan config:clear

# Test the login with valid reCAPTCHA (automatic in v3)
# Visit: http://yourapp.local/login
```

## Optional: Customize Score Threshold

Edit `.env`:
```env
RECAPTCHA_SCORE_THRESHOLD=0.7  # More strict
RECAPTCHA_SCORE_THRESHOLD=0.3  # More lenient
```

## Optional: Rate Limiting

Current rate limit: 5 login attempts per minute per email + IP

Modify in `FortifyServiceProvider.php`:
```php
return Limit::perMinute(10)->by($throttleKey);  // Change 5 to 10
```

## Troubleshooting

| Issue | Solution |
|-------|----------|
| "reCAPTCHA is not configured" | Check `.env` has `RECAPTCHA_SITE_KEY` and `RECAPTCHA_SECRET_KEY` |
| Form won't submit | Check browser console for JavaScript errors |
| Always fails validation | Verify keys are correct and active in Google reCAPTCHA admin |
| False positives | Lower `RECAPTCHA_SCORE_THRESHOLD` in `.env` |
