<main class="marginTop">
    <section class="container">
        <div class="background widthContainer">
            <h2 class="marginBottom">Contact</h2>
            <form class="formContact" action="index.php?page=contact" method="post" enctype="multipart/form-data">
                <div class="inputContainer">
                    <div class="styledInput">
                        <select class="select" name="choiceOne" id="choiceOne">
                            <option>Choisissez...</option>
                            <?php foreach ($firstChoices as $firstChoice): ?>
                                <option value="<?= isset($firstChoice) ? htmlentities($firstChoice['id']) : ''; ?>"><?= isset($firstChoice) ? htmlentities($firstChoice['content']) : ''; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <select class="select" name="choiceTwo" id="choiceTwo" style="display: none;">
                        </select>
                        <span style="color: red; display: block" id="choiceOneError"></span>
                        <span style="color: red; display: block" id="choiceTwoError"></span>
                    </div>
                    <div class="containerName">
                        <div class="styledInput">
                            <label for="name">Nom :<span class="mandatory">*</span></label>
                            <input class="id" type="text" name="name" id="name" value="<?= isset($_SESSION['user']) ? htmlentities($infoUser['name']) : ''; ?>">
                            <span style="color: red;" id="nameError"></span>
                        </div>
                        <div class="styledInput">
                            <label for="firstname">Prénom :<span class="mandatory">*</span></label>
                            <input class="id" type="text" name="firstname" id="firstname" value="<?= isset($_SESSION['user']) ? htmlentities($infoUser['firstname']) : ''; ?>">
                            <span style="color: red;" id="firstnameError"></span>
                        </div>
                    </div>
                    <div class="styledInput">
                        <label for="email">Email :<span class="mandatory">*</span></label>
                        <input class="id" type="text" name="emailMess" id="emailMess" value="<?= isset($_SESSION['user']) ? htmlentities($infoUser['email']) : ''; ?>">
                        <span style="color: red;" id="emailMessError"></span>
                        <span style="color: red;" id="validEmailError"></span>
                    </div>
                    <div class="styledInput">
                        <label for="mobile">Mobile :</label>
                        <input class="id" type="text" name="mobile" id="mobile" value="<?= isset($_SESSION['user']) ? htmlentities($infoUser['mobile']) : ''; ?>">
                    </div>
                    <div class="styledInput">
                        <label for="message">Message :<span class="mandatory">*</span></label>
                        <textarea name="message" id="message"></textarea>
                        <span style="color: red;" id="messageError"></span>
                    </div>
                    <div id="containerButtonSend">
                        <div class="btn" type="submit" name="sendMessage" id="sendMessage">Envoyez</div>
                    </div>
                </div>
                <p id="msgSuccess"></p>
            </form>
        </div>
    </section>
</main>