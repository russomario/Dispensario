<?php include 'templates/header.php'; ?>

    <div class="container center">

        <h1>Aggiungi una medicina</h1>

    <form action="index.php" method="POST" style="width: 40%; margin-left: 350px;" enctype="multipart/form-data">
        <div class="row">
            <div class="col s12 mylabel">Nome
                <div class="input-field inline myinput nomargin">
                    <input name="nome" type="text" placeholder="Nome medicina">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 mylabel">Tipo
            <div class="input-field inline myinput nomargin">
                <input name="tipo" type="text" placeholder="Aspirina, Liquido, Compressa">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 mylabel">Quantit&agrave;
            <div class="input-field inline myinput nomargin">
                <input name="quant" type="text" placeholder="3">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 mylabel">Cassetto
            <div class="input-field inline myinput nomargin">
                <input name="cassetto" type="text" placeholder="1">
            </div>
            </div>
        </div>

        <div class="row">
            <div class="col s12 mylabel">Quando

                <p class="nomargin" style="display: inline-block">
                    <label>
                        <input name="Monday" type="checkbox"/>
                        <span>Luned&igrave;</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Monday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 118px;">
                    <label>
                        <input name="Tuesday" type="checkbox"/>
                        <span>Marted&igrave;</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Tuesday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 125px;">
                    <label>
                        <input name="Wednesday" type="checkbox"/>
                        <span>Mercoled&igrave;</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Wednesday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 110px;">
                    <label>
                        <input name="Thursday" type="checkbox"/>
                        <span>Gioved&igrave;</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Thursday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 115px;">
                    <label>
                        <input name="Friday" type="checkbox"/>
                        <span>Venerd&igrave;</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Friday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 105px;">
                    <label>
                        <input name="Saturday" type="checkbox"/>
                        <span>Sabato</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Saturday" type="text">
                </div>

                <p class="nomargin" style="display: inline-block; margin-left: 120px;">
                    <label>
                        <input name="Sunday" type="checkbox"/>
                        <span>Domenica</span>
                    </label>
                </p>
                <div class="input-field inline myinput nomargin" style="display:inline-block; width: 20%;">
                    <input name="ora_Sunday" type="text">
                </div>

                
            </div>
        </div>

        <div class="row">
            <div class="col s12 mylabel">Durata cura
            <div class="input-field inline myinput">
                <input name="durata" type="text" placeholder="in giorni">
            </div>
            </div>
        </div>

        <div class="file-field input-field">
            <div class="btn">
                <span>Foto</span>
                <input type="file" name="foto" accept="image/png, image/gif, image/jpeg">
            </div>
            <div class="file-path-wrapper">
                <input name="nomefoto" class="file-path validate" type="text">
            </div>
        </div>

        <button class="btn waves-effect waves-light" type="submit">Salva
            <i class="material-icons right">send</i>
        </form>
  
    </div>

    <?php include "./templates/footer.php"; ?>