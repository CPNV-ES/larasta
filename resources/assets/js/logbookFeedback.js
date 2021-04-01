
var feedbacksAndAcknowleges = [];

function getFeedbacks(e) {
  var index = feedbacksAndAcknowleges.indexOf(e.name);
  
  if (~index) {
    feedbacksAndAcknowleges[index + 1] = e.value;
  }else{
    feedbacksAndAcknowleges.push("feedback", e.name, e.value);
  }
  
}