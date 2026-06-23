const PROJECTS = window.PROJECTS || [];


let cp=0;
function open(idx){
  cp=idx; const p=PROJECTS[idx];
  document.getElementById('lb-title').textContent=p.title;
  document.getElementById('lb-sub').textContent=p.sub;
  const b=document.getElementById('lb-body');
  b.innerHTML='';
  p.images.forEach(i=>{
    if (i) {
      const img=document.createElement('img');
      img.src=i;
      b.appendChild(img);
    }
  });
  const lb=document.getElementById('lb');
  lb.classList.add('open'); lb.scrollTop=0;
  document.body.style.overflow='hidden';
}
function close(){document.getElementById('lb').classList.remove('open');document.body.style.overflow='';}
document.querySelectorAll('.pc[data-project]').forEach(c=>c.addEventListener('click',()=>open(parseInt(c.dataset.project))));
document.getElementById('lb-close').addEventListener('click',close);
document.getElementById('lb-prev').addEventListener('click',()=>open((cp-1+PROJECTS.length)%PROJECTS.length));
document.getElementById('lb-next').addEventListener('click',()=>open((cp+1)%PROJECTS.length));
document.addEventListener('keydown',e=>{
  if(e.key==='Escape')close();
  if(e.key==='ArrowRight')document.getElementById('lb-next').click();
  if(e.key==='ArrowLeft')document.getElementById('lb-prev').click();
});
const cur=document.getElementById('cur'),ring=document.getElementById('cur-ring');
let mx=window.innerWidth/2,my=window.innerHeight/2,rx=mx,ry=my;
document.addEventListener('mousemove',e=>{mx=e.clientX;my=e.clientY;cur.style.transform=`translate(${mx}px,${my}px) translate(-50%,-50%)`});
(function tick(){rx+=(mx-rx)*.1;ry+=(my-ry)*.1;ring.style.transform=`translate(${rx}px,${ry}px) translate(-50%,-50%)`;requestAnimationFrame(tick)})();
document.querySelectorAll('a,button,.pc,.sk,.lb-close,.lb-navbtn').forEach(el=>{
  el.addEventListener('mouseenter',()=>document.body.classList.add('hov'));
  el.addEventListener('mouseleave',()=>document.body.classList.remove('hov'));
});
const obs=new IntersectionObserver(e=>e.forEach(x=>{if(x.isIntersecting)x.target.classList.add('on')}),{threshold:.07,rootMargin:'0px 0px -28px 0px'});
document.querySelectorAll('.rv').forEach(el=>obs.observe(el));
setTimeout(()=>document.querySelectorAll('.hero .rv').forEach(el=>el.classList.add('on')),100);
document.querySelectorAll('a[href^="#"]').forEach(a=>a.addEventListener('click',e=>{
  e.preventDefault();const t=document.querySelector(a.getAttribute('href'));if(t)t.scrollIntoView({behavior:'smooth'});
}));

/* ── CONTACT: Particle canvas ── */
(function(){
  const canvas = document.getElementById('contact-particles');
  if (!canvas) return;
  const ctx = canvas.getContext('2d');
  const ACCENT = 'rgba(232,255,71,';
  let W, H, pts = [];

  function resize() {
    const sec = document.getElementById('contact');
    W = canvas.width  = sec.offsetWidth;
    H = canvas.height = sec.offsetHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  const N = 38;
  for (let i = 0; i < N; i++) {
    pts.push({
      x: Math.random() * W,
      y: Math.random() * H,
      vx: (Math.random() - .5) * .45,
      vy: (Math.random() - .5) * .45,
      r: Math.random() * 1.5 + .5
    });
  }

  function draw() {
    ctx.clearRect(0, 0, W, H);
    // Draw connecting lines
    for (let i = 0; i < pts.length; i++) {
      for (let j = i + 1; j < pts.length; j++) {
        const dx = pts[i].x - pts[j].x;
        const dy = pts[i].y - pts[j].y;
        const d  = Math.sqrt(dx*dx + dy*dy);
        if (d < 130) {
          ctx.beginPath();
          ctx.strokeStyle = ACCENT + (1 - d/130) * .22 + ')';
          ctx.lineWidth = .6;
          ctx.moveTo(pts[i].x, pts[i].y);
          ctx.lineTo(pts[j].x, pts[j].y);
          ctx.stroke();
        }
      }
    }
    // Draw dots
    pts.forEach(p => {
      ctx.beginPath();
      ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
      ctx.fillStyle = ACCENT + '.55)';
      ctx.fill();
      // Move
      p.x += p.vx; p.y += p.vy;
      if (p.x < 0 || p.x > W) p.vx *= -1;
      if (p.y < 0 || p.y > H) p.vy *= -1;
    });
    requestAnimationFrame(draw);
  }
  draw();
})();

/* ── CONTACT: Social blocks staggered reveal ── */
(function(){
  const row = document.getElementById('contact-soc-row');
  if (!row) return;
  const socObs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        row.querySelectorAll('.soc-block').forEach((el, i) => {
          setTimeout(() => el.classList.add('soc-visible'), i * 110);
        });
        socObs.disconnect();
      }
    });
  }, { threshold: .25 });
  socObs.observe(row);
})();

/* ══════════════════════════════════════════
   SITE-WIDE TECH ANIMATIONS
   ══════════════════════════════════════════ */

/* ── Site init line ── */
(function(){
  const line = document.createElement('div');
  line.id = 'site-init-line';
  document.body.prepend(line);
  setTimeout(() => line.remove(), 1000);
})();

/* ── Nav: scroll progress bar + scrolled class ── */
(function(){
  const bar = document.createElement('div');
  bar.id = 'nav-progress';
  document.body.prepend(bar);
  const nav = document.querySelector('nav');
  window.addEventListener('scroll', () => {
    const pct = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100;
    bar.style.width = Math.min(pct, 100) + '%';
    nav && nav.classList.toggle('scrolled', window.scrollY > 60);
  }, {passive: true});
})();

/* ── Hero: typewriter tagline ── */
(function(){
  const tag = document.querySelector('.htag');
  if (!tag) return;
  const text = tag.textContent.trim();
  tag.textContent = '';
  const cursor = document.createElement('span');
  cursor.className = 'htag-cursor';
  let i = 0;
  function type() {
    if (i <= text.length) {
      tag.textContent = text.slice(0, i);
      tag.appendChild(cursor);
      i++;
      setTimeout(type, i === 1 ? 400 : 38);
    }
  }
  setTimeout(type, 300);
})();


/* ── Hero grid: parallax on mouse ── */
(function(){
  const grid = document.querySelector('.hgrid');
  if (!grid) return;
  document.addEventListener('mousemove', e => {
    const dx = (e.clientX / window.innerWidth - .5) * 14;
    const dy = (e.clientY / window.innerHeight - .5) * 14;
    grid.style.transform = `translate(${dx}px,${dy}px)`;
  }, {passive: true});
})();

/* ── Section headings + tags: animate in ── */
(function(){
  const headObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('heading-visible');
        headObs.unobserve(e.target);
      }
    });
  }, {threshold: .3});
  const tagObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('tag-visible');
        tagObs.unobserve(e.target);
      }
    });
  }, {threshold: .3});
  document.querySelectorAll('.stit').forEach(el => headObs.observe(el));
  document.querySelectorAll('.stag').forEach(el => tagObs.observe(el));
})();

/* ── Skill cards: sweep div + stagger ── */
(function(){
  document.querySelectorAll('.sk').forEach((sk, i) => {
    // inject sweep highlight
    const sw = document.createElement('div');
    sw.className = 'sk-sweep';
    sk.appendChild(sw);
    // stagger entrance
    sk.classList.add('sk-enter');
    sk.style.transitionDelay = (i * 0.07) + 's';
  });
  const skObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('sk-visible');
        skObs.unobserve(e.target);
      }
    });
  }, {threshold: .15});
  document.querySelectorAll('.sk.sk-enter').forEach(el => skObs.observe(el));
})();

/* ── Project cards: scan overlay & stagger entrance ── */
(function(){
  const pcs = document.querySelectorAll('.pc');
  pcs.forEach((card, i) => {
    const scan = document.createElement('div');
    scan.className = 'pc-scan';
    card.appendChild(scan);
    // stagger setup
    card.classList.add('pc-enter');
  });

  const pcObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const idx = [...pcs].indexOf(e.target);
        // stagger reveal based on index
        setTimeout(() => e.target.classList.add('pc-visible'), (idx % 3) * 120);
        pcObs.unobserve(e.target);
      }
    });
  }, {threshold: .15});
  
  pcs.forEach(el => pcObs.observe(el));
})();

/* ── About stats: count-up ── */
(function(){
  function countUp(el) {
    const target = parseInt(el.textContent.replace(/\D/g,'')) || 0;
    const suffix = el.textContent.replace(/[\d]/g,'');
    let current = 0;
    const step = Math.max(1, Math.floor(target / 40));
    el.classList.add('counting');
    const iv = setInterval(() => {
      current = Math.min(current + step, target);
      el.textContent = current + suffix;
      if (current >= target) { clearInterval(iv); el.classList.remove('counting'); }
    }, 30);
  }
  const statObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.querySelectorAll('.an').forEach(countUp);
        statObs.unobserve(e.target);
      }
    });
  }, {threshold: .4});
  const stats = document.querySelector('.astats');
  if (stats) statObs.observe(stats);
})();

/* ── Timeline: stagger entrance ── */
(function(){
  const items = document.querySelectorAll('.tli');
  const tlObs = new IntersectionObserver(entries => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        const idx = [...items].indexOf(e.target);
        setTimeout(() => e.target.classList.add('tli-visible'), idx * 90);
        tlObs.unobserve(e.target);
      }
    });
  }, {threshold: .2});
  items.forEach(el => tlObs.observe(el));
})();

/* ── Buttons: neon ripple on click ── */
(function(){
  document.querySelectorAll('.btnp,.btng,.ncta').forEach(btn => {
    btn.addEventListener('click', e => {
      const r = btn.getBoundingClientRect();
      const rpl = document.createElement('span');
      rpl.className = 'btn-ripple';
      rpl.style.left = (e.clientX - r.left - 4) + 'px';
      rpl.style.top  = (e.clientY - r.top  - 4) + 'px';
      btn.appendChild(rpl);
      setTimeout(() => rpl.remove(), 550);
    });
  });
})();

/* ── Sections: data-label watermarks ── */
(function(){
  const labels = {
    'work':    'PROJECTS',
    'skills':  'CAPABILITIES',
    'about':   'BACKGROUND',
    'contact': 'CONNECT',
  };
  Object.entries(labels).forEach(([id, label]) => {
    const sec = document.getElementById(id);
    if (sec) sec.dataset.label = label;
  });
})();