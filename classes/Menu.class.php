<?php
/**
 * Description of Menu
 *
 * @author pj
 */
class Menu extends Objet {
    
    public function __construct() {
        parent::__construct();
        $this->dbConnect();
    }
    
    public function __destruct() {
        parent::__destruct();
    }
    
    /**
     * Description of Display
     * 
     *  display the menu
     */
    public function display() {
        ?>
<div id="menu">
    <ul class="menu">
        <li>
            <a href="index.html"><span>Accueil</span></a>
        </li>
        <li>
            <a href="#" class="parent"><span>Compagnie</span></a>
            <div>
                <ul>
<!--                    <li><a href="presentation.html"><span>Présentation</span></a></li>-->
                    <li><a href="historique.html"><span>Historique</span></a></li>
                    <li><a href="personnes.html"><span>Les Personnes</span></a></li>
                    <li><a href="page-18-ils-ont-joue.html"><span>Ils ont joué</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#" class="parent"><span>Ils jouent</span></a>
            <div>
                <ul>
                    <?php
                    $spectacles=new Spectacles();
                    $spectacles->dispMenu();
                    ?>
                </ul>
            </div>
        </li>
        <li>
            <a href="#" class="parent"><span>Festival</span></a>
            <div>
                <ul>
                    <li><a href="page-6-festival-presentation.html"><span>Présentation</span></a></li>
                    <li><a href="page-8-festival-inscription.html"><span>Inscription</span></a></li>
                    <li><a href="page-12-festival-annees-precedentes.html"><span>Années précédentes</span></a></li>
                </ul>
            </div>
        </li>
        <li>
            <a href="#" class="parent"><span>Les petits Escholiers</span></a>
            <div>
                <ul>
                    <li><a href="page-13-les-petits-echoliers-presentation.html"><span>Présentation</span></a></li>
<!--                    <li><a href="#"><span>Inscription</span></a></li>-->
                </ul>
            </div>
        </li>
        <li>
            <a href="#" class="parent"><span>Galeries</span></a>
            <div>
                <ul>
                    <li><a href="galeries-photo.html"><span>Photos</span></a></li>
                    <li><a href="videos.html"><span>Vidéos</span></a></li>
                </ul>
            </div>
        </li>
        <li class="last">
            <a href="#" class="parent"><span>Plus</span></a>
            <div>
                <ul>
                    <li><a href="plan-acces.html"><span>Plan d'accès</span></a></li>
                    <li><a href="contact.html"><span>Contact</span></a></li>
                    <li><a href="page-5-13-remerciements.html"><span>Remerciements</span></a></li>
                    <li><a href="page-11-14--liens.html"><span>Liens</span></a></li>
                    <li><a href="livre-d-or.html"><span>Livre d'or</span></a></li>
                </ul>
            </div>
        </li>
    </ul>
</div>
<?php
    }
}

?>
