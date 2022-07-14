export function correctTimeZone(numOfHours, date) {
    date = new Date(date);
    date.setTime(date.getTime() + numOfHours * 60 * 60 * 1000);
    return date;
}

