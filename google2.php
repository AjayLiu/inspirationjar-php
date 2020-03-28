<script src="https://apis.google.com/js/platform.js" async defer></script>
<meta name="google-signin-client_id" content="549099927731-c1aqlvs43ftmc88t3b22t3eg6b4q2hgl.apps.googleusercontent.com">

<div class="g-signin2" data-onsuccess="onSignIn"></div>

<script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
</script>