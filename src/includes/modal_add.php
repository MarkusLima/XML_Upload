<button class="btn btn-success position-fixed bottom-0 end-0" style="margin-bottom: 25px; margin-right: 25px; z-index: 5;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">+</button>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Upload</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex justify-content-center align-items-center">
        <form action="./src/function/add_xml.php" method="POST" accept="" id="form_envio">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <img src="../../asset/xml-file.png" class="img-thumbnail d-none" alt="..." id="img_xml" style="max-width: 30%;">
            </div>
            <div class="input-group mb-3">
                <input type="file" class="form-control" name="meu_arquivo" id="file" onchange="validationFile()" required>
            </div>
            <div class="d-flex justify-content-end align-items-end">
                <button type="button" class="btn btn-primary" id="btn_submit" disabled>SEND XML</button>
            </div>
        </form>
    </div>
</div>