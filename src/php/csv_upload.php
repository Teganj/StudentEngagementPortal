<!-- Import link -->
<div class="col-md-12 head">
    <div class="float-right" style="width: 100%;">
        <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');" style="background-color: #bdb2b2; color: black; padding: 14px 20px; margin: 8px 0; border: none; cursor: pointer;
    width: 30%; position: relative;"><i class="plus"></i>
            Upload CSV</a>
    </div>
</div>
<!-- CSV file upload form -->
<div class="col-md-12" id="importFrm" style="display: none;">
    <form action="importData.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file"/>
        <input type="submit" class="btn btn-primary" name="importSubmit" value="IMPORT">
    </form>
</div>
