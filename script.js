 function submitMood() { 
    const mood = document.getElementById("moodInput").value; 
    if (!mood) {
      alert("Please describe your mood to get book recommendations.");
      return;
    }
    sessionStorage.setItem("userMood", mood); 
    window.location.href = "results.php"; 
  }
  const prompts = [
    "Feeling nostalgic?",
    "Need something magical?",
    "Feeling rebellious?",
    "Looking for a comfort read?",
    "Feeling adventurous?",
    "Craving something romantic?",
    "In the mood for mystery?"
  ];
  
  let current = 0;
  const moodBox = document.getElementById("moodInput");
  
  setInterval(() => {
    moodBox.placeholder = prompts[current];
    current = (current + 1) % prompts.length; } , 3000 ); 
  