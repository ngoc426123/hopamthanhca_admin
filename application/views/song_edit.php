<form action="" method="post">
<div class="row">
    <div class="col-12">
        <div class="form-group bmd-form-group">
            <label class="bmd-label-floating">Tên bài hát</label>
            <input type="text" class="form-control" id="songTitle" value='<?php echo $song["title"] ?>'>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-lg-8 col-xl-9">
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Nội dung</h4>
                </div>
                <div class="pull-right">
                    <button type='button' class='btn btn-sm btn-primary'><i class="material-icons">visibility</i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="editor"><?php echo $song["content"] ?></div>
            </div>
            <div class="card-body">
                <div id="seen"><?php echo convent_song($song["content"]); ?></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Seo Engine</h4>
                </div>
                <div class="pull-right">
                    <button type='button' class='btn btn-sm btn-primary'><i class="material-icons">file_copy</i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">SEO Title</label>
                            <input type="text" class="form-control" value='<?php echo $song["meta"]["seotitle"] ?>'>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">SEO Url</label>
                            <input type="text" class="form-control" value='<?php echo $song["meta"]["seourl"] ?>'>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">SEO Meta decription</label>
                            <input type="text" class="form-control" value='<?php echo $song["meta"]["seodes"] ?>'>
                        </div>
                        <div class="form-group bmd-form-group">
                            <label class="bmd-label-floating">SEO Keyworks</label>
                            <input type="text" class="form-control" value='<?php echo $song["meta"]["seokeywork"] ?>'>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="box-seo">
                            <div class="seo-header"><i class="fa fa-google"></i> Search Engine Optimization</div>
                            <div class="seo-content">
                                <div class="seo-title" id="seo-title"><?php echo $song["meta"]["seotitle"] ?></div>
                                <div class="seo-url" id="seo-url">http://hopamthanhca.com/<?php echo $song["meta"]["seourl"] ?></div>
                                <div class="seo-desc" id="seo-desc"><?php echo $song["meta"]["seodes"] ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Meta bài hát</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">File nhạc</label>
                    <input type="text" class="form-control" value='<?php echo $song["meta"]["pdffile"] ?>'>
                </div>
                <div class="form-group bmd-form-group">
                    <label class="bmd-label-floating">Lời đầu</label>
                    <input class="form-control" value='<?php echo $song["excerpt"] ?>'>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-4 col-xl-3">
        <div class="card">
            <div class="card-body">
                <div class="togglebutton">
                    <label><input type="checkbox" <?php echo ($song['status']=='publish')?'checked':'' ?>>Publish <span class="toggle"></span></label>
                </div>
                <div>Publish on: <b class='font-weight-bold'><?php echo $song["date"] ?></b></div>
            </div>
            <div class="card-footer justify-content-end">
                <button type='submit' class='btn btn-success'>Đăng</button>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Chuyên mục</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-over card-form-check">
                <?php
                foreach ($cat['chuyen-muc'] as $item) {
                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" <?php echo ($song['cat']['chuyen-muc'] == $item['id'])?'checked':'' ?> type="checkbox" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
                            <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Tác giả</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-over card-form-check">
                <?php
                foreach ($cat['tac-gia'] as $item) {
                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" <?php echo ($song['cat']['tac-gia'] == $item['id'])?'checked':'' ?> type="checkbox" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
                            <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Bảng chữ cái</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-over card-form-check">
                <?php
                foreach ($cat['bang-chu-cai'] as $item) {
                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" <?php echo ($song['cat']['bang-chu-cai'] == $item['id'])?'checked':'' ?> type="checkbox" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
                            <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header card-header-rose card-header-text">
                <div class="card-text">
                    <h4 class="card-title">Điệu bài hát</h4>
                </div>
            </div>
            <div class="card-body">
                <div class="card-over card-form-check">
                <?php
                foreach ($cat['dieu-bai-hat'] as $item) {
                ?>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" <?php echo ($song['cat']['dieu-bai-hat'] == $item['id'])?'checked':'' ?> type="checkbox" value="<?php echo $item['id'] ?>"> <?php echo $item['cat_name'] ?>
                            <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                    </div>
                <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
<script src="<?php echo base_url('tmp/js/ckeditor5/ckeditor.js'); ?>"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        });
</script>