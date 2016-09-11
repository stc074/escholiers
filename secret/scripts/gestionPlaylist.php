<?php
$playlist=new PlaylistVideo();
$playlist->testMov();
$playlist->testDel();
?>
<h2>Gestion de la playliste</h2>
<p>Les videos sont séparés (fichiers puis Youtube), dans chaque partie vous pouvez modifier les positions ou effacer la vidéo.</p>
<h2>Playliste de vidéos</h2>
<div id="colRightMedia">
<div id='mediaspace' class="mediaspace2">This text will be replaced</div>
</div>
<script type='text/javascript'>
  jwplayer('mediaspace').setup({
    'flashplayer': '../mediaplayer-5.10-viral/player.swf',
    'playlistfile': '../playlist.php',
    'playlist': 'bottom',
    'controlbar': 'bottom',
    'width': '470',
    'height': '470'
  });
</script>
<div id="colLeftMedia">
    <?php
    $playlist->dispListVideos();
    ?>
</div>
