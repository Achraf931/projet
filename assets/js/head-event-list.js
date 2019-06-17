let cal = null;
window.onload = function () {
    cal = new WinkelCalendar({
        container: 'cuppaDatePickerContainer',
        bigBanner: true,
        defaultDate: Date(),
        format: "DD-MM-YYYY",
        onSelect: onDateChange
    });
}
function onDateChange(date) {
}