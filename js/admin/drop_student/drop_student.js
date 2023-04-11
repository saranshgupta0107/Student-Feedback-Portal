document.getElementById('csvfile1').addEventListener('change', read1)
document.getElementById('csvfile2').addEventListener('change', read2)
var submit = document.getElementById('submit2');
async function read1(evt) {
    console.log(evt);
    if (evt.target.files.length == 0) {
        submit.disabled = true;
        return;
    }
    await excelFileToJSON1(evt.target.files[0])
    submit.disabled = false;
}
async function excelFileToJSON1(file) {
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
                var hidden = document.getElementById('file_data1')
                hidden.value = result;
            });
        }
    } catch (e) {
        console.error(e);
    }
}
var submit2 = document.getElementById('submit5');
async function read2(evt) {
    console.log(evt);
    if (evt.target.files.length == 0) {
        submit2.disabled = true;
        return;
    }
    await excelFileToJSON2(evt.target.files[0])
    submit2.disabled = false;
}
async function excelFileToJSON2(file) {
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
                var hidden = document.getElementById('file_data2')
                hidden.value = result;
            });
        }
    } catch (e) {
        console.error(e);
    }
}