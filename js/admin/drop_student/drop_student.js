document.getElementById('csvfile').addEventListener('change', read)
var submit = document.getElementById('submit2');
async function read(evt) {
    if (evt.target.files.length == 0) {
        submit.disabled = true;
        return;
    }
    await excelFileToJSON(evt.target.files[0])
    submit.disabled = false;
}
async function excelFileToJSON(file) {
    try {
        var reader = new FileReader();
        reader.readAsBinaryString(file);
        reader.onload = function (e) {
            var result;
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            workbook.SheetNames.forEach(function (sheetName) {
                var roa = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                if (roa.length > 0) {
                    result = JSON.stringify(roa, null, 4);
                }
                var hidden = document.getElementById('file_data')
                hidden.value = result;
                console.log(result);
            });
        }
    } catch (e) {
        console.error(e);
    }
}