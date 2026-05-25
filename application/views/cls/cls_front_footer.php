<!-- ============================================================
     PASTE เฉพาะส่วนนี้ลงใน footer ของคุณ
     (ลบ <h4>What our guests say</h4> เดิมออกด้วย)
     ============================================================ -->

<style>
/* ── scoped ทั้งหมด ใช้ prefix .gs- เพื่อไม่ชนกับ CSS อื่น ── */
.gs-wrap {
  position: relative;
  width: 100%;
  max-width: 860px;
  margin: 0 auto;
  padding: 20px 20px 48px;
  text-align: center;
  overflow: hidden; /* ครอบ deco-lines ไว้ใน section */
}

/* Decorative curves — position:absolute ใน .gs-wrap */
.gs-deco {
  position: absolute;
  bottom: 0; left: 0;
  width: 200px;
  opacity: .10;
  pointer-events: none;
}

.gs-label {
  font-size: .68rem;
  font-weight: 400;
  letter-spacing: .28em;
  text-transform: uppercase;
  color: #888278;
  display: block;
  margin-bottom: 28px;
}

.gs-quote-mark {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: 5.5rem;
  line-height: .6;
  color: #b89a5a;
  opacity: .45;
  margin-bottom: 24px;
  display: block;
  user-select: none;
}

/* Slider */
.gs-overflow { overflow: hidden; }
.gs-inner {
  display: flex;
  transition: transform .7s cubic-bezier(.4,0,.2,1);
}
.gs-slide {
  min-width: 100%;
  padding: 0 36px;
}

.gs-text {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(1.1rem, 2.5vw, 1.45rem);
  font-weight: 300;
  font-style: italic;
  line-height: 1.8;
  color: #c8c0b0;
  max-width: 660px;
  margin: 0 auto 28px;
  opacity: 0;
  transform: translateY(16px);
  transition: opacity .55s ease, transform .55s ease;
}
.gs-slide.gs-active .gs-text { opacity: 1; transform: translateY(0); }

.gs-name {
  font-size: .8rem;
  font-weight: 500;
  letter-spacing: .18em;
  text-transform: uppercase;
  color: #e8e2d8;
  opacity: 0;
  transform: translateY(8px);
  transition: opacity .5s .12s ease, transform .5s .12s ease;
}
.gs-slide.gs-active .gs-name { opacity: 1; transform: translateY(0); }

.gs-role {
  font-size: .7rem;
  color: #888278;
  letter-spacing: .08em;
  margin-top: 4px;
  opacity: 0;
  transform: translateY(6px);
  transition: opacity .5s .2s ease, transform .5s .2s ease;
}
.gs-slide.gs-active .gs-role { opacity: 1; transform: translateY(0); }

/* Arrows */
.gs-arrows {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 44px 0 0;
}
.gs-arr {
  width: 52px; height: 52px;
  border: 1px solid #2a2a2a;
  background: transparent;
  color: #e8e2d8;
  font-size: .95rem;
  cursor: pointer;
  display: flex; align-items: center; justify-content: center;
  transition: border-color .2s, background .2s, color .2s;
  flex-shrink: 0;
}
.gs-arr:hover {
  border-color: #b89a5a;
  background: rgba(184,154,90,.08);
  color: #b89a5a;
}
.gs-arr-line {
  flex: 1;
  height: 1px;
  background: #2a2a2a;
  margin: 0 20px;
}

/* Avatars */
.gs-avs {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 12px;
  margin-top: 40px;
}
.gs-av-wrap { cursor: pointer; }
.gs-av {
  width: 48px; height: 48px;
  border-radius: 50%;
  object-fit: cover;
  display: block;
  opacity: .32;
  border: 1.5px solid transparent;
  transition: opacity .3s, border-color .3s, transform .3s;
}
.gs-av-wrap.gs-active .gs-av {
  opacity: 1;
  border-color: #b89a5a;
  transform: scale(1.14);
}
.gs-av-wrap:hover .gs-av { opacity: .6; }
.gs-av-dot {
  width: 4px; height: 4px;
  border-radius: 50%;
  background: #b89a5a;
  margin: 5px auto 0;
  opacity: 0;
  transition: opacity .3s;
}
.gs-av-wrap.gs-active .gs-av-dot { opacity: 1; }

@media (max-width: 576px) {
  .gs-slide { padding: 0 12px; }
  .gs-arr { width: 44px; height: 44px; }
}
</style>

<footer id="divElement" class="footer">
    <div class="container">
        <div class="row ">
					<?php foreach ($hotels as $index => $hotel): 
            $title = $this->session->userdata('lang') == 'en'
                ? ($hotel['title_en'] ?? '')
                : ($hotel['title_th'] ?? '');

						$parts        = explode(' ', $title);
						$firstChar    = mb_substr($parts[0], 0, 1,);        
						$restOfFirst  = mb_substr($parts[0], 1, null,);     
						$firstColored = '<span style="color:#f62a0a;">' . $firstChar . '</span>' . $restOfFirst;
						$rest         = count($parts) > 1 ? ' ' . implode(' ', array_slice($parts, 1)) : '';
            $delay        = round(($index + 1) * 0.1, 1) . 's'; ?>

            <div class="col-lg-3 col-6 text-center col-md-6 footer-links wow fadeIn animated" data-wow-delay="<?= $delay ?>">
                <div>
                    <h3 class="text-white"><?= $firstColored . $rest ?></h3>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <div class="container">
        <div class="copyright">
            <div class="row">
                <div class="col-lg-12 mb-3 "><h5>
									<? if ($this->session->userdata('lang') == 'en'): ?>
									<?= $subTitle['sub_desc_en']  ?? ''; ?>
								<? else: ?>
									<?= $subTitle['sub_desc_th'] ?? ''; ?>
								<? endif; ?>	</h5>
									
                </div>
                 <div class="col-lg-10 mx-auto mb-3 text-center">
                     <img src="<?= base_url("uploads/title/" . $subTitle['image']) ?>" width="100%">
                     <h2 class="mt-3"> 
											<? if($this->session->userdata('lang') == 'en'): ?>
											<?='What our guests say'??'';?>
											<? else: ?>
											<?='สิ่งที่แขกของเราพูด' ?? ''; ?>
											<? endif;?>
										</h2>
                 </div>
                
            </div>

            <div class="row">
                <div class="col-lg-12 mb-3 ">
                  <div class="gs-wrap">

  <!-- Decorative curves (absolute ใน wrapper) -->
  <svg class="gs-deco" viewBox="0 0 220 320" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M-20 320 C40 260 30 180 80 120 C130 60 180 40 200 -10" stroke="#a09070" stroke-width="1"/>
    <path d="M-20 300 C40 240 28 165 78 108 C128 48 176 28 196 -20" stroke="#a09070" stroke-width="1"/>
    <path d="M-20 280 C40 220 26 150 76 96 C126 36 174 16 192 -30" stroke="#a09070" stroke-width="1"/>
    <path d="M-20 260 C38 200 24 135 74 84 C124 24 172 4 188 -40" stroke="#a09070" stroke-width="1"/>
  </svg>

  <span class="gs-label">
		<? if($this->session->userdata('lang') == 'en'): ?>
					<?='What our guests say'??'';?>
		<? else: ?>
					<?='สิ่งที่แขกของเราพูด' ?? ''; ?>
		<? endif;?>
	</span>
	
  <span class="gs-quote-mark">"</span>

  <div class="gs-overflow">
    <div class="gs-inner" id="gsInner">

      <div class="gs-slide gs-active">
        <p class="gs-text">Staying at iHotels was an unforgettable experience. The staff went above and beyond to ensure our comfort and satisfaction. The room was immaculate, with breath-taking views.</p>
        <div class="gs-name">Jenny Wilson</div>
        <div class="gs-role">Business Owner · New York</div>
      </div>

      <div class="gs-slide">
        <p class="gs-text">ตั้งแต่ก้าวเข้ามาในโรงแรม รู้สึกได้ทันทีถึงความใส่ใจในทุกรายละเอียด ห้องพักสะอาดหมดจด วิวเมืองเชียงใหม่ยามเช้าสวยงามมาก ทีมงานทุกท่านยิ้มแย้มและเอาใจใส่อย่างสม่ำเสมอ</p>
        <div class="gs-name">ธนกร วงศ์ทอง</div>
        <div class="gs-role">นักธุรกิจ · กรุงเทพฯ</div>
      </div>

      <div class="gs-slide">
        <p class="gs-text">The location is perfect — walking distance to Wualai Walking Street. Breakfast was exceptional and the room was spotlessly clean. Will definitely stay again next trip to Chiang Mai.</p>
        <div class="gs-name">Marcus Chen</div>
        <div class="gs-role">Architect · Singapore</div>
      </div>

      <div class="gs-slide">
        <p class="gs-text">เราพักที่นี่เพื่อฉลองวันครบรอบแต่งงาน โรงแรมเตรียมดอกไม้และของขวัญไว้ให้โดยไม่ได้บอก ประทับใจมากที่สุดในชีวิต จะกลับมาทุกปีแน่นอนค่ะ</p>
        <div class="gs-name">นภาพร สุขสวัสดิ์</div>
        <div class="gs-role">ครีเอทีฟ ไดเร็คเตอร์ · เชียงใหม่</div>
      </div>

    </div>
  </div>

  <!-- Arrows -->
  <div class="gs-arrows">
    <button class="gs-arr" id="gsPrev">&#8592;</button>
    <div class="gs-arr-line"></div>
    <button class="gs-arr" id="gsNext">&#8594;</button>
  </div>

  <!-- Avatars -->
  <div class="gs-avs">
    <div class="gs-av-wrap gs-active" data-gs="0">
      <img class="gs-av" src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?w=120&h=120&fit=crop&crop=face&q=80" alt="Jenny"/>
      <div class="gs-av-dot"></div>
    </div>
    <div class="gs-av-wrap" data-gs="1">
      <img class="gs-av" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=120&h=120&fit=crop&crop=face&q=80" alt="Thanakorn"/>
      <div class="gs-av-dot"></div>
    </div>
    <div class="gs-av-wrap" data-gs="2">
      <img class="gs-av" src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=120&h=120&fit=crop&crop=face&q=80" alt="Marcus"/>
      <div class="gs-av-dot"></div>
    </div>
    <div class="gs-av-wrap" data-gs="3">
      <img class="gs-av" src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=120&h=120&fit=crop&crop=face&q=80" alt="Napaporn"/>
      <div class="gs-av-dot"></div>
    </div>
  </div>

</div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
(function() {
  var inner  = document.getElementById('gsInner');
  var slides = inner.querySelectorAll('.gs-slide');
  var avs    = document.querySelectorAll('.gs-av-wrap');
  var cur    = 0, timer;

  function goTo(i) {
    slides[cur].classList.remove('gs-active');
    avs[cur].classList.remove('gs-active');
    cur = (i + slides.length) % slides.length;
    inner.style.transform = 'translateX(-' + (cur * 100) + '%)';
    slides[cur].classList.add('gs-active');
    avs[cur].classList.add('gs-active');
  }

  document.getElementById('gsPrev').addEventListener('click', function() { clearInterval(timer); goTo(cur - 1); start(); });
  document.getElementById('gsNext').addEventListener('click', function() { clearInterval(timer); goTo(cur + 1); start(); });

  avs.forEach(function(av) {
    av.addEventListener('click', function() { clearInterval(timer); goTo(+av.dataset.gs); start(); });
  });

  var tx = 0;
  inner.addEventListener('touchstart', function(e) { tx = e.changedTouches[0].clientX; }, {passive:true});
  inner.addEventListener('touchend', function(e) {
    var dx = e.changedTouches[0].clientX - tx;
    if (Math.abs(dx) > 40) { clearInterval(timer); goTo(dx < 0 ? cur + 1 : cur - 1); start(); }
  });

  function start() { timer = setInterval(function() { goTo(cur + 1); }, 5000); }
  start();
})();
</script>
