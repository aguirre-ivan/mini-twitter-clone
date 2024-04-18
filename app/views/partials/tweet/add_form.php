<?php

$profile_image = $page_data['user_data']['profile_image'] ?? DEFAULT_PROFILE_IMG_PATH;

?>

<div class="add-tweet-form-container">
    <div class="user-profile-img">
        <img src="<?= IMG_DIRECTORY . $profile_image ?>" alt="User profile image">
    </div>
    <form class="add-tweet-form" method="POST" action="/tweet/create">
        <textarea class="twitter-sign-input" name="tweet_content" rows="4" cols="50" placeholder="¡¿Qué está pasando?!" required></textarea>
        <button class="twitter-btn twitter-btn--lightblue" type="submit">Tweet</button>
    </form>
</div>