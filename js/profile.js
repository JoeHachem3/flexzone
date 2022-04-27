var w = document.getElementById("levelProgress").innerHTML;
document.getElementById("progress").style.width = w + "%";








function showProfile(){
  document.getElementById('profile').style.visibility = "visible";
  document.getElementById('profile').style.opacity = 1;
  document.getElementById('profileButton').classList.add('clicked');

  document.getElementById('fz-games').style.visibility = "hidden";
  document.getElementById('fz-games').style.opacity = 0;
  document.getElementById('fz-gamesButton').classList.remove('clicked');

  document.getElementById('community').style.visibility = "hidden";
  document.getElementById('community').style.opacity = 0;
  document.getElementById('communityButton').classList.remove('clicked');

  document.getElementById('navDiv').style.visibility = "hidden";
  document.getElementById('navDiv').style.opacity = 0;
  document.getElementById('navDiv').style.width = 0;
}

function showFZGames(){
  document.getElementById('fz-games').style.visibility = "visible";
  document.getElementById('fz-games').style.opacity = 1;
  document.getElementById('fz-gamesButton').classList.add('clicked');

  document.getElementById('profile').style.visibility = "hidden";
  document.getElementById('profile').style.opacity = 0;
  document.getElementById('profileButton').classList.remove('clicked');

  document.getElementById('community').style.visibility = "hidden";
  document.getElementById('community').style.opacity = 0;
  document.getElementById('communityButton').classList.remove('clicked');

  document.getElementById('navDiv').style.visibility = "hidden";
  document.getElementById('navDiv').style.opacity = 0;
  document.getElementById('navDiv').style.width = 0;

  
var y = document.getElementById('y').innerHTML;
var m = document.getElementById('m').innerHTML;
var d = document.getElementById('d').innerHTML;


var endDate = new Date(m + ' ' + d + ', ' + y + ' 00:00:00').getTime();

function countDown(){
  var now = new Date().getTime();
  var gap = endDate - now;

  var second = 1000;
  var minute = second * 60;
  var hour = minute * 60;
  var day = hour * 24;

  var d = Math.floor(gap / (day));
  var h = Math.floor((gap % (day)) / (hour));
  var m = Math.floor((gap % (hour)) / (minute));
  var s = Math.floor((gap % (minute)) / second);

  document.getElementById('day').innerHTML = d;
  document.getElementById('hour').innerHTML = h;
  document.getElementById('minute').innerHTML = m;
  document.getElementById('second').innerHTML = s;
}

setInterval(function(){countDown();}, 1000);

}

function showCommunity(){
  document.getElementById('community').style.visibility = "visible";
  document.getElementById('community').style.opacity = 1;
  document.getElementById('communityButton').classList.add('clicked');

  document.getElementById('profile').style.visibility = "hidden";
  document.getElementById('profile').style.opacity = 0;
  document.getElementById('profileButton').classList.remove('clicked');

  document.getElementById('fz-games').style.visibility = "hidden";
  document.getElementById('fz-games').style.opacity = 0;
  document.getElementById('fz-gamesButton').classList.remove('clicked');

  document.getElementById('navDiv').style.visibility = "hidden";
  document.getElementById('navDiv').style.opacity = 0;
  document.getElementById('navDiv').style.width = 0;
}








function choose() {
  document.getElementById("chooseImage").click();
}

function update() {
  document.getElementById("update").click();
}

function logout() {
    document.getElementById("logout").click();
}



function showSkills() {
  document.getElementById("profileSkillsDiv").style.visibility = "visible";
  document.getElementById("profileSkillsDiv").style.marginTop = "0";
  document.getElementById("profileSkillsDiv").style.opacity = "1";

  document.getElementById("downSkills").style.visibility = "hidden";
  document.getElementById("upSkills").style.visibility = "visible";
  document.getElementById("upSkills").style.zIndex = "3";
    
}

function hideSkills() {
  document.getElementById("profileSkillsDiv").style.visibility = "hidden";
  document.getElementById("profileSkillsDiv").style.marginTop = "-10em";
  document.getElementById("profileSkillsDiv").style.opacity = "0";

  document.getElementById("downSkills").style.visibility = "visible";
  document.getElementById("upSkills").style.visibility = "hidden";
  document.getElementById("upSkills").style.zIndex = "1";
}


function showEquip() {
  document.getElementById("equipmentList").style.visibility = "visible";
  document.getElementById("equipmentList").style.marginTop = "0";
  document.getElementById("equipmentList").style.opacity = "1";

  document.getElementById("downEquip").style.visibility = "hidden";
  document.getElementById("upEquip").style.visibility = "visible";
  document.getElementById("upEquip").style.zIndex = "3";
}

function hideEquip() {
  document.getElementById("equipmentList").style.visibility = "hidden";
  document.getElementById("equipmentList").style.marginTop = "-10em";
  document.getElementById("equipmentList").style.opacity = "0";

  document.getElementById("downEquip").style.visibility = "visible";
  document.getElementById("upEquip").style.visibility = "hidden";
  document.getElementById("upEquip").style.zIndex = "1";
}

function changeEquip(e) {
  document.getElementById("eq").innerHTML = e;
}



function showSchedule() {
  document.getElementById("profileScheduleDiv").style.visibility = "visible";
  document.getElementById("profileScheduleDiv").style.marginTop = "0";
  document.getElementById("profileScheduleDiv").style.opacity = "1";

  document.getElementById("downSchedule").style.visibility = "hidden";
  document.getElementById("upSchedule").style.visibility = "visible";
  document.getElementById("upSchedule").style.zIndex = "3";
    
}

function hideSchedule() {
  document.getElementById("profileScheduleDiv").style.visibility = "hidden";
  document.getElementById("profileScheduleDiv").style.marginTop = "-10em";
  document.getElementById("profileScheduleDiv").style.opacity = "0";

  document.getElementById("downSchedule").style.visibility = "visible";
  document.getElementById("upSchedule").style.visibility = "hidden";
  document.getElementById("upSchedule").style.zIndex = "1";
}




function showButtons() {
  document.getElementById('add').style.borderTopRightRadius = 0;
  document.getElementById('add').style.borderTopLeftRadius = 0;
  document.getElementById('buttonList').style.visibility = "visible";
  document.getElementById('buttonList').style.opacity = "1";
}

function hideButtons() {
  document.getElementById('add').style.borderRadius = "50%";
  document.getElementById('buttonList').style.visibility = "hidden";
  document.getElementById('buttonList').style.opacity = "0";
}




function showGymnast() {
  document.getElementById("addGymnastForm").style.visibility="visible";
  document.getElementById("addGymnastForm").style.opacity = 1;
  document.getElementById("addGymnastDiv").style.visibility = "visible";
  document.getElementById("addGymnastDiv").style.top = "50%";
}

function cancelGymnast() {
  document.getElementById("addGymnastForm").style.visibility="hidden";
  document.getElementById("addGymnastForm").style.opacity = 0;
  document.getElementById("addGymnastDiv").style.visibility = "hidden";
  document.getElementById("addGymnastDiv").style.top = "200%";
}

function confirmGymnast() {
  document.getElementById("confirmGymnast").click();
}







function showCoach() {
  document.getElementById("addCoachForm").style.visibility="visible";
  document.getElementById("addCoachForm").style.opacity = 1;
  document.getElementById("addCoachDiv").style.visibility = "visible";
  document.getElementById("addCoachDiv").style.top = "50%";
}

function cancelCoach() {
  document.getElementById("addCoachForm").style.visibility="hidden";
  document.getElementById("addCoachForm").style.opacity = 0;
  document.getElementById("addCoachDiv").style.visibility = "hidden";
  document.getElementById("addCoachDiv").style.top = "200%";
}

function confirmCoach() {
  document.getElementById("confirmCoach").click();
}





function showClass() {
  document.getElementById("addClassForm").style.visibility="visible";
  document.getElementById("addClassForm").style.opacity = 1;
  document.getElementById("addClassDiv").style.visibility = "visible";
  document.getElementById("addClassDiv").style.top = "50%";
}

function cancelClass() {
  document.getElementById("addClassForm").style.visibility="hidden";
  document.getElementById("addClassForm").style.opacity = 0;
  document.getElementById("addClassDiv").style.visibility = "hidden";
  document.getElementById("addClassDiv").style.top = "200%";
}

function confirmClass() {
  document.getElementById("confirmClass").click();
}




function showTask() {
  document.getElementById("addTaskForm").style.visibility="visible";
  document.getElementById("addTaskForm").style.opacity = 1;
  document.getElementById("addTaskDiv").style.visibility = "visible";
  document.getElementById("addTaskDiv").style.top = "50%";
}

function cancelTask() {
  document.getElementById("addTaskForm").style.visibility="hidden";
  document.getElementById("addTaskForm").style.opacity = 0;
  document.getElementById("addTaskDiv").style.visibility = "hidden";
  document.getElementById("addTaskDiv").style.top = "200%";
}

function confirmTask() {
  document.getElementById("confirmTask").click();
}





function showSkill() {
  document.getElementById("addSkillForm").style.visibility="visible";
  document.getElementById("addSkillForm").style.opacity = 1;
  document.getElementById("addSkillDiv").style.visibility = "visible";
  document.getElementById("addSkillDiv").style.top = "50%";
}

function cancelSkill() {
  document.getElementById("addSkillForm").style.visibility="hidden";
  document.getElementById("addSkillForm").style.opacity = 0;
  document.getElementById("addSkillDiv").style.visibility = "hidden";
  document.getElementById("addSkillDiv").style.top = "200%";
}

function confirmSkill() {
  document.getElementById("confirmSkill").click();
}






function showReview() {
  document.getElementById("addReviewForm").style.visibility="visible";
  document.getElementById("addReviewForm").style.opacity = 1;
  document.getElementById("addReviewDiv").style.visibility = "visible";
  document.getElementById("addReviewDiv").style.top = "50%";
}

function cancelReview() {
  document.getElementById("addReviewForm").style.visibility="hidden";
  document.getElementById("addReviewForm").style.opacity = 0;
  document.getElementById("addReviewDiv").style.visibility = "hidden";
  document.getElementById("addReviewDiv").style.top = "200%";
}

function confirmReview() {
  document.getElementById("confirmReview").click();
}






function showChallenge() {
  document.getElementById("addChallengeForm").style.visibility="visible";
  document.getElementById("addChallengeForm").style.opacity = 1;
  document.getElementById("addChallengeDiv").style.visibility = "visible";
  document.getElementById("addChallengeDiv").style.top = "50%";
}

function cancelChallenge() {
  document.getElementById("addChallengeForm").style.visibility="hidden";
  document.getElementById("addChallengeForm").style.opacity = 0;
  document.getElementById("addChallengeDiv").style.visibility = "hidden";
  document.getElementById("addChallengeDiv").style.top = "200%";
}

function confirmChallenge() {
  document.getElementById("confirmChallenge").click();
}


function showUpdateGymnast(){
  document.getElementById("UpdateGymnastForm").style.visibility="visible";
  document.getElementById("UpdateGymnastForm").style.opacity = 1;
  document.getElementById("UpdateGymnastDiv").style.visibility = "visible";
  document.getElementById("UpdateGymnastDiv").style.top = "50%";
}

function cancelUpdateGymnast() {
  document.getElementById("UpdateGymnastForm").style.visibility="hidden";
  document.getElementById("UpdateGymnastForm").style.opacity = 0;
  document.getElementById("UpdateGymnastDiv").style.visibility = "hidden";
  document.getElementById("UpdateGymnastDiv").style.top = "200%";
}

function confirmUpdateGymnast() {
  document.getElementById("confirmUpdateGymnast").click();
}







function showNav(){
  document.getElementById('navDiv').style.visibility = "visible";
  document.getElementById('navDiv').style.opacity = 1;
  document.getElementById('navDiv').style.width = "40%";

  hideButtons();
  cancelClass();
  cancelCoach();
  cancelGymnast();
  cancelReview();
  cancelSkill();
  cancelTask();
}

function hideNav(){
  document.getElementById('navDiv').style.visibility = "hidden";
  document.getElementById('navDiv').style.opacity = 0;
  document.getElementById('navDiv').style.width = 0;
}