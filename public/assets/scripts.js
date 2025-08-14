document.addEventListener('DOMContentLoaded',()=>{
  const botForm = document.getElementById('bot-form');
  if(botForm){
    botForm.addEventListener('submit', async (e)=>{
      e.preventDefault();
      const q = botForm.querySelector('input[name=q]').value.trim();
      if(!q) return;
      const log = document.getElementById('bot-log');
      const userMsg = document.createElement('div');
      userMsg.className='card'; userMsg.textContent='You: ' + q;
      log.appendChild(userMsg);
      const res = await fetch('api/chatbot_api.php',{
        method:'POST',
        headers:{'Content-Type':'application/json'},
        body: JSON.stringify({q})
      });
      const data = await res.json();
      const botMsg = document.createElement('div');
      botMsg.className='card'; botMsg.textContent='Bot: ' + (data.answer || 'No answer found.');
      log.appendChild(botMsg);
      botForm.reset();
      log.scrollTop = log.scrollHeight;
    });
  }

  // checklist add
  const addItem = document.getElementById('add-checklist-item');
  if(addItem){
    addItem.addEventListener('click', async ()=>{
      const text = prompt('Checklist item');
      if(!text) return;
      const res = await fetch('api/checklist_api.php',{method:'POST',headers:{'Content-Type':'application/json'},body:JSON.stringify({action:'add', text})});
      location.reload();
    });
  }
});
