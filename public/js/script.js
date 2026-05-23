
// FAQ
function toggleFaq(btn){const item=btn.closest('.faq-item');item.classList.toggle('open')}
// Gallery tabs
function showGallery(t){document.getElementById('photosGrid').classList.toggle('d-none',t!=='photos');document.getElementById('videosGrid').classList.toggle('d-none',t!=='videos');document.getElementById('photosBtn').className='btn '+(t==='photos'?'btn-primary':'btn-light')+' rounded-pill px-4';document.getElementById('videosBtn').className='btn '+(t==='videos'?'btn-primary':'btn-light')+' rounded-pill px-4'}
// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a=>{a.addEventListener('click',e=>{const t=document.querySelector(a.getAttribute('href'));if(t){e.preventDefault();t.scrollIntoView({behavior:'smooth'});const nav=document.getElementById('navMenu');if(nav.classList.contains('show'))bootstrap.Collapse.getInstance(nav)?.hide()}})});

// Back to top
const btt = document.querySelector('.back-to-top');
window.addEventListener('scroll',()=>{ if(window.scrollY>300) btt.classList.add('show'); else btt.classList.remove('show');});
btt?.addEventListener('click',e=>{e.preventDefault();window.scrollTo({top:0,behavior:'smooth'});});

// CAPTCHA generator
function genCaptcha(){
  const chars='ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
  let s='';for(let i=0;i<6;i++)s+=chars[Math.floor(Math.random()*chars.length)];
  return s;
}
// const cap=document.getElementById('captchaText');
const refresh=document.getElementById('refreshCaptcha');
if(cap){
  let current=genCaptcha();cap.textContent=current;
  refresh?.addEventListener('click',()=>{current=genCaptcha();cap.textContent=current;});
  cap.dataset.value=current;
  const f=cap.closest('form');
  f?.addEventListener('submit',e=>{cap.dataset.value=cap.textContent;});
}

// State -> City dependent dropdown
const STATES = window.STATES_CITIES||{};
const stateSel=document.getElementById('state');
const citySel=document.getElementById('city');
stateSel?.addEventListener('change',()=>{
  citySel.innerHTML='<option value="">Select city</option>';
  (STATES[stateSel.value]||[]).forEach(c=>{
    const o=document.createElement('option');o.value=c;o.textContent=c;citySel.appendChild(o);
  });
});

// Registration form handling
const regForm=document.getElementById('registerForm');
regForm?.addEventListener('submit',function(e){
  e.preventDefault();
  const data=Object.fromEntries(new FormData(regForm).entries());
  //const captchaInput=document.getElementById('captchaInput').value.trim().toUpperCase();
  // const expected=document.getElementById('captchaText').dataset.value.toUpperCase();
  if(captchaInput!==expected){alert('CAPTCHA incorrect. Please try again.');return;}
  const username=(data.name||'user').toLowerCase().replace(/[^a-z0-9]/g,'').slice(0,8)+Math.floor(Math.random()*900+100);
  const password='CC'+Math.random().toString(36).slice(2,8).toUpperCase();
  const payload={...data,username,password,createdAt:new Date().toISOString()};
  const list=JSON.parse(localStorage.getItem('cc_registrations')||'[]');
  list.push(payload);localStorage.setItem('cc_registrations',JSON.stringify(list));
  localStorage.setItem('cc_lastReg',JSON.stringify(payload));
  localStorage.setItem('cc_user',JSON.stringify(payload));
  window.location.href='thank-you.html';
});

// Thank you page
const thankBox=document.getElementById('thankYouBox');
if(thankBox){
  const last=JSON.parse(localStorage.getItem('cc_lastReg')||'null');
  if(last){
    document.getElementById('tyName').textContent=last.name||'';
    document.getElementById('tyEmail').textContent=last.email||'';
    document.getElementById('tyUser').textContent=last.username;
    document.getElementById('tyPass').textContent=last.password;
  }
}

// Olympiad form
const olyForm=document.getElementById('olympiadForm');
olyForm?.addEventListener('submit',e=>{
  e.preventDefault();
  alert('Olympiad registration submitted! We will contact you shortly.');
  olyForm.reset();
});

// Gallery lightbox
document.querySelectorAll('.gallery-item').forEach(el=>{
  el.addEventListener('click',()=>{
    const src=el.querySelector('img').src;
    document.getElementById('lightboxImg').src=src;
    new bootstrap.Modal(document.getElementById('lightbox')).show();
  });
});

// Contact form
document.getElementById('contactForm')?.addEventListener('submit',e=>{
  e.preventDefault();alert('Thanks! We will get back to you soon.');e.target.reset();
});


/* === Auth helpers === */
function togglePw(inputId, btn){
  var el = document.getElementById(inputId);
  if(!el) return;
  var icon = btn.querySelector('i');
  if(el.type === 'password'){ el.type='text'; if(icon){icon.classList.remove('bi-eye');icon.classList.add('bi-eye-slash');} }
  else { el.type='password'; if(icon){icon.classList.remove('bi-eye-slash');icon.classList.add('bi-eye');} }
}

function pwScore(pw){
  var s = 0;
  if(pw.length >= 8) s++;
  if(/[A-Z]/.test(pw)) s++;
  if(/[a-z]/.test(pw)) s++;
  if(/\d/.test(pw)) s++;
  if(/[^A-Za-z0-9]/.test(pw)) s++;
  return s;
}

function bindPwStrength(inputId, barId, hintId){
  var inp = document.getElementById(inputId);
  if(!inp) return;
  inp.addEventListener('input', function(){
    var v = inp.value;
    var s = pwScore(v);
    var bar = document.getElementById(barId);
    if(bar){
      var inner = bar.firstElementChild;
      var pct = (s/5)*100;
      var color = s<=2?'#dc3545':(s<=3?'#ffc107':'#28a745');
      inner.style.width = pct + '%';
      inner.style.background = color;
    }
    var hint = document.getElementById(hintId);
    if(hint){
      var checks = {
        len: v.length>=8,
        up:  /[A-Z]/.test(v),
        lo:  /[a-z]/.test(v),
        num: /\d/.test(v),
        sym: /[^A-Za-z0-9]/.test(v)
      };
      ['len','up','lo','num','sym'].forEach(function(k){
        var sp = hint.querySelector('[data-c="'+k+'"]');
        if(sp) sp.classList.toggle('ok', checks[k]);
      });
    }
  });
}

/* Login submit (demo - localStorage) */
function doLogin(e){
  e.preventDefault();
  var u = document.getElementById('loginUser').value.trim();
  var p = document.getElementById('loginPass').value;
  var box = document.getElementById('loginMsg');
  if(!u || !p){ box.innerHTML='<div class="alert alert-danger">Please enter both fields.</div>'; return false; }
  var stored = JSON.parse(localStorage.getItem('cc_user') || 'null');
  if(stored && (stored.username === u || stored.email === u) && stored.password === p){
    box.innerHTML='<div class="alert alert-success">Login successful! Redirecting...</div>';
    sessionStorage.setItem('cc_session', JSON.stringify({u:stored.username, t:Date.now()}));
    setTimeout(function(){ window.location='index.html'; }, 1000);
  } else {
    box.innerHTML='<div class="alert alert-danger">Invalid credentials. Try registering first.</div>';
  }
  return false;
}

/* Forgot password (demo) */
function doForgot(e){
  e.preventDefault();
  var email = document.getElementById('fpEmail').value.trim();
  var box = document.getElementById('fpMsg');
  if(!email){ box.innerHTML='<div class="alert alert-danger">Enter your registered email.</div>'; return false; }
  var stored = JSON.parse(localStorage.getItem('cc_user') || 'null');
  if(stored && stored.email === email){
    var token = Math.random().toString(36).slice(2,10);
    sessionStorage.setItem('cc_reset', JSON.stringify({email:email, token:token, t:Date.now()}));
    box.innerHTML='<div class="alert alert-success">Reset link sent to <strong>'+email+'</strong>.<br>'+
      '<a href="create-password.html?token='+token+'" class="alert-link">Click here to reset now (demo)</a></div>';
  } else {
    box.innerHTML='<div class="alert alert-warning">No account with that email. <a href="register.html" class="alert-link">Register</a></div>';
  }
  return false;
}

/* Create / reset password */
function doCreatePw(e){
  e.preventDefault();
  var p1 = document.getElementById('newPw').value;
  var p2 = document.getElementById('newPw2').value;
  var box = document.getElementById('cpMsg');
  if(p1.length < 8){ box.innerHTML='<div class="alert alert-danger">Password must be at least 8 characters.</div>'; return false; }
  if(p1 !== p2){ box.innerHTML='<div class="alert alert-danger">Passwords do not match.</div>'; return false; }
  if(pwScore(p1) < 3){ box.innerHTML='<div class="alert alert-warning">Choose a stronger password.</div>'; return false; }
  var stored = JSON.parse(localStorage.getItem('cc_user') || 'null');
  if(stored){ stored.password = p1; localStorage.setItem('cc_user', JSON.stringify(stored)); }
  box.innerHTML='<div class="alert alert-success">Password updated successfully! Redirecting to login...</div>';
  setTimeout(function(){ window.location='login.html'; }, 1500);
  return false;
}

/* Thank-you copy buttons */
function ccCopy(id, btn){
  var el = document.getElementById(id);
  if(!el) return;
  var t = el.textContent;
  navigator.clipboard.writeText(t).then(function(){
    var orig = btn.innerHTML;
    btn.innerHTML = '<i class="bi bi-check2"></i> Copied';
    setTimeout(function(){ btn.innerHTML = orig; }, 1500);
  });
}
 AOS.init({
    duration: 1000,
    once: false   // animate every slide change
  });