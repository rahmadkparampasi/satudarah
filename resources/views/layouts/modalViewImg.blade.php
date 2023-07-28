<div id="modalViewImg" class="modal" tabindex="-1" role="dialog" aria-labelledby="modalViewImgTitle" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalViewImgTitle">Pratinjau Gambar</h5>
                <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group w-100">
                    <img id="viewImgPre" src="{{url('assets/img/image.png')}}" alt="Pratinjau Gambar" class="w-100"/>
                </div>
            </div>
            <div class="modal-footer">
                <div class="item form-group">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showPreviewImg(src){
        var imgSrc = document.getElementById(src.getAttribute('id'));
        var preview = document.getElementById("viewImgPre");
        preview.src = imgSrc.src;
        preview.style.display = "block";
    }
    function showPreviewImgSrc(src){
        var preview = document.getElementById("viewImgPre");
        preview.src = src;
        preview.style.display = "block";
    }
</script>