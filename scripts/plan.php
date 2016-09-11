<h1>Coordonnées</h1>
<h2>Les Escholiers</h2>
    <?php
    $acces=new Acces();
    $acces->loadAddress();
    //$acces->compCoords();*/
    ?>
<p><?php echo nl2br($acces->getAddress()); ?></p>
<h2>Plan d'accès</h2>
<div id="mapCanvas"></div>
<script type="text/javascript">
    initialize(45.9020725, 6.1247439);
</script>
