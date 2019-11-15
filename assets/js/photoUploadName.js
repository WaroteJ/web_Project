    $('#img').on('change',function(){
        //get the file name
        let fileName = $(this).val();
        let cleanFileName = fileName.replace('C:\\fakepath\\', " ");
        //replace the "Choose a file" label
        $(this).next('.custom-file-label').html(cleanFileName);
    })