//This will increase the textarea height automatically
document.addEventListener("DOMContentLoaded", function () {
    var textarea = document.querySelector("textarea");
    var lineHeight = parseInt(getComputedStyle(textarea).lineHeight);
  
    textarea.addEventListener("input", function () {
      this.style.height = "auto";
      var height = Math.min(this.scrollHeight, lineHeight * 8);
      this.style.height = height + "px";
    });
  
    textarea.addEventListener("keydown", function (e) {
      if (
        (e.key === "Backspace" || e.key === "Delete") &&
        this.value.trim() !== ""
      ) {
        var rows = this.value.split("\n").length;
        var height = Math.min(lineHeight * (rows + 1), lineHeight * 8);
        this.style.height = height + "px";
      }
      if (e.key === "Enter") {
        e.preventDefault();
      }
    });
  });
  
  const form = document.querySelector("form");
  const chatContainer = document.querySelector("#chat_container");

  const info = document.getElementById('info');
  
  let loadInterval;
  
  function loader(element) {
    element.textContent = "";
  
    loadInterval = setInterval(() => {
      // Update the text content of the loading indicator
      element.textContent += ".";
  
      // If the loading indicator has reached three dots, reset it
      if (element.textContent === "....") {
        element.textContent = "";
      }
    }, 300);
  }
  
  function typeText(element, text) {
    let index = 0;
  
    let interval = setInterval(() => {
      if (index < text.length) {
        element.innerHTML += text.charAt(index);
        index++;
      } else {
        clearInterval(interval);
      }
    }, 20);
  }
  
  // generate unique ID for each message div of bot
  // necessary for typing text effect for that specific reply
  // without unique ID, typing text will work on every element
  function generateUniqueId() {
    const timestamp = Date.now();
    const randomNumber = Math.random();
    const hexadecimalString = randomNumber.toString(16);
  
    return `id-${timestamp}-${hexadecimalString}`;
  }
  
  function chatStripe(isAi, value, uniqueId) {
    return `
          <div class="w-full text-gray-200  py-4 ${isAi && "bg-[#031B34] text-gray-200"}">
              <div class="w-11/12 max-w-1280 mx-auto flex flex-row items-start gap-2.5">
                  <div class="rounded-md flex justify-center items-center">
                    ${
                        isAi ? 
                        '<div class="bg-gradient-to-br from-pink-500 to-orange-400 p-1"><img src="../resources/assets/bot.svg" alt="ai" class="w-6 h-6"/></i></div>' 
                        : '<div class="bg-gradient-to-br from-green-400 to-blue-600 p-1"><img src="../resources/assets/user.svg" alt="ai" class="w-6 h-6"/></i></div>'
                    }
                    
                  </div>
                  <div class="flex-1 text-md max-w-full overflow-x-auto white-space-prewrap scollbar-none" id=${uniqueId}>${value}</div>
              </div>
          </div>
      `;
  }
  
  const handleSubmit = async (e) => {
    // #10a37f
    e.preventDefault();

    info.classList.add('hidden');
    chatContainer.classList.remove('justify-center','items-center');

    if (document.querySelector("textarea").value.length > 0) {
      const data = new FormData(form);
  
      // user's chatstripe
      chatContainer.innerHTML += chatStripe(false, data.get("prompt"));
  
      // to clear the textarea input
      form.reset();
  
      // bot's chatstripe
      const uniqueId = generateUniqueId();
      chatContainer.innerHTML += chatStripe(true, " ", uniqueId);
  
      // to focus scroll to the bottom
      chatContainer.scrollTop = chatContainer.scrollHeight;
  
      // specific message div
      const messageDiv = document.getElementById(uniqueId);
  
      // messageDiv.innerHTML = "..."
      loader(messageDiv);
  
      const response = await fetch("http://localhost:5000/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          prompt: data.get("prompt"),
        }),
      });
  
      clearInterval(loadInterval);
      messageDiv.innerHTML = " ";
  
      if (response.ok) {
        const data = await response.json();
        const parsedData = data.bot.trim(); // trims any trailing spaces/'\n'
  
        typeText(messageDiv, parsedData);
      } else {
        const err = await response.text();
  
        messageDiv.innerHTML = "Something went wrong";
        alert(err);
      }
    }
  };
  
  form.addEventListener("submit", handleSubmit);
  form.addEventListener("keyup", (e) => {
    if (e.key === 'Enter') {
      handleSubmit(e);
    }
  });