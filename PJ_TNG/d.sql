USE todo;

CREATE TABLE recom_routine(
	recom_no INT PRIMARY KEY AUTO_INCREMENT  
	,recom_title VARCHAR(33) NOT NULL 
	,recom_contents VARCHAR(50) NOT NULL 
	);
	
CREATE DATABASE todo;

todoCREATE TABLE routine_info (
	routine_no INT PRIMARY KEY AUTO_INCREMENT
	,routine_title VARCHAR(33) NOT NULL
	,routine_contents VARCHAR(50) NOT NULL
	,routine_due_time time DEFAULT NOW()
	,routine_write_date DATETIME DEFAULT NOW()
	,routine_del_flg CHAR(1) DEFAULT '0'
	,routine_del_date DATETIME NULL
);

CREATE TABLE routine_list(
	list_no INT PRIMARY KEY AUTO_INCREMENT
	,routine_no INT NOT NULL 
	,list_title VARCHAR(33) NOT NULL
	,list_contents VARCHAR(50) NOT NULL
	,list_due_time TIME NOT NULL 
	,list_done_flg CHAR(1) DEFAULT '0'
	,list_now_date DATETIME DEFAULT NOW()
	)
;
COMMIT;

INSERT INTO recom_routine(
	recom_title
	,recom_contents
	)
VALUES
('아침 조깅', '숨이 차지 않을 정도로 달리기')
,('반신욕', '욕조에서 반신욕')
,('명상', '취침전 하루 돌아보기')
,('스트레칭', '취침전 간단한 스트레칭')
,('산책', '집주변 산책하기')
,('찜질', '따뜻한 물수건 스팀찜질')
,('마사지', '뭉친 몸 풀어주기')
,('우유한잔', '잠이 안올 때 따뜻한 우유 한잔')
,('샤워', '따듯한 물에 샤워')
,('영양제 섭취', '식후 알맞은 영양제 섭취')
;

FLUSH PRIVILEGES;

INSERT INTO routine_info(
	routine_title
	,routine_contents
	)
VALUES
('제목1', '내용1')
,('제목2', '내용2')
;