<?php global $file ?>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdn.azk1.net/player/plyr/autosize.min.js"></script>
<script src="https://cdn.azk1.net/player/plyr/script.js"></script>

<?php if (((page() == "embed" && siteinfo('video_embed')) || (page() == "dl" && siteinfo('video_preview'))) && $file['type'] == 'video') { ?>
<script src="https://cdn.azk1.net/player/plyr/plyr.js"></script>
<script>
    var player = new Plyr('#player', {
        settings: ""
    });
</script>
<?php } ?>

</body>
</html>