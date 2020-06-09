

<h1>Zoekfilters:</h1>

<form action="./includes/zoekresultaten.php">
    <input type="radio" name="typeFiets" value="herenfietsen"> herenfietsen<br>
    <input type="radio" name="typeFiets" value="damesfietsen"> damesfietsen<br>
    <input type="radio" name="typeFiets" value="kinderfietsen" > kinderfietsen<br>
    <input type="radio" name="typeFiets" value="elektrisch" > elektrisch<br>
    <input type="radio" name="typeFiets" value="accessoires" > accessoires<br>
    <input type="checkbox" name="prijs" value=">500" > > 500 €<br>
    <input type="checkbox" name="prijs" value="<500" > < 500 €<br>
    <input type="checkbox" name="voorraad" value=">0" > op voorraad<br>

    <input type="submit" value="zoeken">
</form>

<form action="./assortiment.php" method="post">
    <input type="submit" name="reset" value="reset">
</form>