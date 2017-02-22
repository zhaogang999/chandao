function createRow()
{
    if(newRowID == 0) newRowID = $('.stepID').size();
    newRowID ++;
    var newRow = "<tr class='text-center' id='row" + newRowID + "'>";
    newRow += "<td class='stepID strong'></td>";
    /*row=1改为row=8*/
    newRow += "<td><textarea name='steps[]' rows=8 class='form-control'></textarea></td>";
    /*文本框加了id*/
    /*newRow += "<td><textarea name='expects[]' rows=1 class='form-control'></textarea></td>";*/
    newRow += "<td><textarea name='expects[]' id='expects" + newRowID + "' rows=1 class='form-control'></textarea></td>";
    newRow += "<td class='text-left text-top'>";
    newRow += "<button type='button' tabindex='-1' class='addbutton btn' title='" + lblBefore + "' onclick='preInsert("  + newRowID + ")' ><i class='icon icon-double-angle-up'></i></button>";
    newRow += "<button type='button' tabindex='-1' class='addbutton btn' title='" + lblAfter  + "' onclick='postInsert(" + newRowID + ")' ><i class='icon icon-double-angle-down'></i></button>";
    newRow += "<button type='button' tabindex='-1' class='delbutton btn' title='" + lblDelete + "' onclick='deleteRow("  + newRowID + ")' ><i class='icon icon-remove'></i></button>";
    newRow += "</td>";
    return newRow;
}

function postInsert(rowID)
{
    $('#row' + rowID).after(createRow());
    $(document).ready(initKindeditor);
    updateStepID();
}

function preInsert(rowID)
{
    $('#row' + rowID).before(createRow());
    $(document).ready(initKindeditor);
    updateStepID();
}