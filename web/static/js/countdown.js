var days_ms=1000*60*60*24
var todayDate=new Date()
var days

var weeding_moth = 5
var weeding_day = 27
var weedingDate=new Date(todayDate.getFullYear(), weeding_moth, weeding_day)

if (todayDate.getMonth()==05 && todayDate.getDate()>31)
    weedingDate.setFullYear(weedingDate.getFullYear()+1)
days = Math.ceil((weedingDate.getTime()-todayDate.getTime())/(days_ms))