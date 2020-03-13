/**
 * EvalGrid specific js
 * 
 * Bastien Nicoud
 */

// Littre function to reduce the arrays
let reducer = (accumulator, currentValue) => accumulator + currentValue

// round with decimal precision
let round = (number, precision) => {
  var factor = Math.pow(10, precision);
  return Math.round(number * factor) / factor
}

// the function to calculate the grade for each section dynamicly
let calculateGrades = () => {
  let grades = {}
  let maxGrades = {}
  
  // select each grade input
  $(".gradeinput").each(function (index) {
    console.log("TUTU")

    // get the id of the section we actually iterates
    let sectionId = parseInt($(this).data("sectionId"))

    // get the grade and maxGrade
    let grade = $(this).is('input') ? parseFloat($(this).val()) : parseFloat($(this).text())
    let maxGrade = parseFloat($(this).data("maxGrade"))

    // create a key with the id of the section a add it an array with field values..
    grades[sectionId] == null ? grades[sectionId] = [grade] : grades[sectionId].push(grade)
    maxGrades[sectionId] == null ? maxGrades[sectionId] = [maxGrade] : maxGrades[sectionId].push(maxGrade)
    
  })

  // iterates each section and calculate the final note
  for (let [key, value] in grades) {

    // sum the grades and the max grates
    let sum = grades[key].reduce((a, b) => a + b, 0)
    let maxSum = maxGrades[key].reduce((a, b) => a + b, 0)

    // calculate the section grade with the federal scale
    let sectionGrade = ((sum / maxSum) * 5) + 1

    // display the grade in the section
    $(`*[data-section-id="${key}"]`).html(round(sectionGrade, 1))

  }
}

$(document).ready(function () {

  // when jquery is ready, calculate the grades
  calculateGrades()

  // Watch the changes on inputs to recalculate the grades
  $("input").change(function () {

    calculateGrades()

  })

})