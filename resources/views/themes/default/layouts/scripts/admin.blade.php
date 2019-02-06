<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<script>
    const options = {
        filebrowserImageBrowseUrl: '{!! config("app.url_admin") !!}/filemanager?type=Images',
        filebrowserImageUploadUrl: '{!! config("app.url_admin") !!}/filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '{!! config("app.url_admin") !!}/filemanager?type=Files',
        filebrowserUploadUrl: '{!! config("app.url_admin") !!}/filemanager/upload?type=Files&_token='
    };

    CKEDITOR.replace('editor', options);

    function confirmDelete() {
        if (!confirm('{!! u__('admin.are you sure to delete this item?') !!}'))
            event.preventDefault();
    }
</script>