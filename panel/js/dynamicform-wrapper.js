$(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
    if (! confirm("Do you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper").on("limitReached", function(e, item) {
    alert("Limit reached items.");
});

/*****************************************************************/

$(".dynamicform_wrapper2").on("beforeInsert", function(e, item) {
    console.log("beforeInsert");
});

$(".dynamicform_wrapper2").on("afterInsert", function(e, item) {
    console.log("afterInsert");
});

$(".dynamicform_wrapper2").on("beforeDelete", function(e, item) {
    if (! confirm("Do you want to delete this item?")) {
        return false;
    }
    return true;
});

$(".dynamicform_wrapper2").on("afterDelete", function(e) {
    console.log("Deleted item!");
});

$(".dynamicform_wrapper2").on("limitReached", function(e, item) {
    alert("Limit reached items.");
});
