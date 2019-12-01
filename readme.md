# 題組一解題步驟


## 步驟一：將素材目錄複製到崗位目錄下，確認素材內容與抽題題號一致
監評長按下倒數計時後，可以先把桌面上素材目錄中的題目素材複製一份到自己的工作目錄下，這時要確認自己複製的題目和抽到的題目是一致的，之後都在工作目錄下來取用相關的素材，這樣比較不容易出錯；在安裝軟體的準備時間裏，也要確認一下電腦桌面中是否有包含了素材這個目錄，並且四個題組的素材都在其中。

---

## 步驟二：將版型檔案及相關素材複製到網站根目錄下，並進行相應的更名及整理
  1. 開立./css, ./js, ./img, ./icon等常用目錄以利檔案分類及管理
  2. 將素材檔中的.css, .js, 及icon圖檔複製到相應的目錄下
  3. 更改版型素材的相關檔名，以符合解題的需要
      * 01P01.html => login.php
      * 01P02.html => index.php
      * 01P03.html => admin.php
      * 01P04.html => news.php
  4. 更改版型素材的相關連結及匯入檔內容
      * 修改 `index.php`,`admin.php` 中 `<link>` 及 `<script>` 中的連結路徑，指向正確的位置
      * 修改 `./css/css.css` 中的圖片 `url` ，指向根目錄下的 `../icon` 目錄
  5. 開啟 `xampp` 及 `apache` 伺服器，使用 `localhost` 或 `127.0.0.1` 檢視網頁是否正確顯示，css 的載入是否正確

---

## 步驟三：進行前後台的檔案整理及切版，分離出共用的區塊或功能。
  1. 建立 `front`及 `admin` 兩個目錄，一個代表前台的相關檔案，一個代表後台的相關檔案，前後台共用的元件則先放在根目錄下，或另開一個 `comm` 目錄用來存放共用的元件
  2. 分離出頁首標題及頁尾頁腳的區塊成為 `header.php` 及 `footer.php`
  3. 前台的 `login.php` 及 `news.php` 去除和 `index.php` 相同的部份，只留下中間區塊即可，並將檔案移到 `./front` 目錄下
  4. 前台的 `index.php` 控出中間的區塊成為獨立的 `home.php` 檔案，並搬移到 `./front/` 目錄下
  5. 後台的 `admin.php` 則挖出中間的區塊成為獨立的元件，在整理後成為九個後台功能的基礎版型檔案。
  6. 使用 `include` 指令來重新組合 `index.php` 及 `admin.php` 頁面，並加上判斷式來確保要組合的檔案是存在的。
  7. 以 `get` 的方式來傳遞各頁面要組合的元件內容，比如 `do=login` 表示要看到的是登入頁面，因此在前台的 `include` 中可以併入 `login.php` 來呈現。
  8. 在 `./front` 目錄中，將 `login.php`, `news.php`, `home.php` 中的 `<marquee>...</marquee>` 也獨立成為一個元件，並放在 `./front/` 目錄下
  9. 在 `./admin` 目錄下根據 `title.php` 來增加其它八項功能的檔案，並更改對應的檔名及檔案內的功能標題內容
  10. 修改 `admin.php` 左方選單中的連結內容由 `href="?do=admin&redo=title"` 改成 `href="?do=title"`，並確認連結可以看到對應的功能內容

```
note:
news.php 及 home.php 下方的<script></script>是用來做為最新消息彈出視窗用的，
因此在切割檔案時，要記得連<script>的部份一起切出去
```

---

## 步驟四：建立資料庫連線檔及常用函式。
  1. 建立 `base.php` 檔，用來放共用的設定及函式。
  2. 設定好PDO的連線參數 `$pdo=new PDO()`
  3. 啟用session `session_start()`
  4. 建立全域變數或是共用函式
      * find(\$table,...\$arg) - 尋找特定條件的單筆資料或第一筆資料
      * all(\$table,...\$arg) - 取得資料表的全部資料或是特定條件的全部資料
      * nums(\$table,...\$arg) - 計算符合條件的資料筆數
      * save(\$talbe,\$data) - 新增或更新單筆資料
      * del(\$table,...\$arg) - 刪除特定條件的全部資料
      * q(\$sql) - 簡化 \$pdo->query(\$sql)->fetchAll() 的使用;
      * to(\$path) - 簡化 header("location:xxxxxx") 的使用;
  5. 做好以上工作後，可以先建一張簡單的資料表，把資料庫連線及所有自訂函式功能先測試一次，以確保後續使用不會有問題。

---

## 步驟五：建立資料表及預設資料。
每個題組依狀況不同，在這一步有不同的做法，視自己對題目的熟悉程度來做應變，可以一次把全部資料表建完，也可以視解題的進度來逐步建立或修改資料表。
這裏我們採用的做法是利用phpmyadmin的複製資料表功能，快速的複製五張欄位相同的資料表（title,ad,mvim,image,news)，
五張類似的資料表並不是所有的欄位都會用得上，我們只是取巧來節省建資料表的時間。

1. 依序建立後台功能需要的九張資料表:
  * title

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |file  |text    |     |         |     | 檔名/路徑 |
    |text  |text    |     |         |     | 文字      |
    |sh    |int(1)  |     |   0     |     | 顯示      |
    
  * ad

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |file  |text    |     |         |     | 檔名/路徑 |
    |text  |text    |     |         |     | 文字     |
    |sh    |int(1)  |     |   1     |     | 顯示     |

  * mvim
  
    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |file  |text    |     |         |     | 檔名/路徑 |
    |text  |text    |     |         |     | 文字     |
    |sh    |int(1)  |     |   1     |     | 顯示     |

  * image

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |file  |text    |     |         |     | 檔名/路徑 |
    |text  |text    |     |         |     | 文字      |
    |sh    |int(1)  |     |   1     |     | 顯示      |

  * total

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  |流水號     |
    |total |int(5)  |     |         |     |訪客數     |

  * bottom

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  |流水號     |
    |bottom|text    |     |         |     |頁尾版權   |

  * news

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |file  |text    |     |         |     | 檔名/路徑 |
    |text  |text    |     |         |     | 文字      |
    |sh    |int(1)  |     |   1     |     | 顯示      |

  * admin

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |acc   |text    |     |         |     | 帳  號    |
    |pw    |text    |     |         |     | 密  碼    |

  * menu

    | name |  type  |  pk | default | A_I |   note   |
    |:----:|:------:|:---:|:-------:|:---:|:--------:|
    |id    |int(5)  |yes  |         |yes  | 流水號    |
    |href  |text    |     |         |     | 連結      |
    |text  |text    |     |         |     | 文字      |
    |parent|int(5)  |     |         |     | 主選單id  |
    |sh    |int(1)  |     |  1      |     | 顯示      |

2. total,bottom,admin這三張表可以先直接手動塞一筆資料進去，如果對資料夠熟悉，也可以每張表都先塞資料進去，這樣在後續製作功能時，可以更快看到成果
3. 為了解題順利，可以把資料表中的一些欄位設為可接受空值的狀況，這樣即使未設定內容，也能正常新增或更改資料，不過這個做法只是為了先求解題完成而做的取巧，實務上應該根據需求及功能來決定欄位是否可以接受空值，並在程式端檢查來源資料是否為空值

---

## 步驟六：製作訪客計數器及頁尾版權文字
由於第一題的前置作業較多，因此建議先把訪客計數器先完成，確認自訂函式及資料庫的存取正常，一來是先看到有個功能完成會比較心安，二來是確認一下前置作業的自訂函式部份有沒有問題。

1. 先整理後台的進站總人數管理功能的頁面，調整HTML的部份符合題意要求的單欄資料內容
2. 確認可從資料表 `total` 中讀取到訪客計數資料
3. 建立 `./api/total.php` 並將資料更新的語法寫入
4. 建立 `session` 變數來紀錄進站人數，並在後台資料變更時，同時更新 `session`
5. 在 `base.php` 中寫入判斷訪客是否是首次進站，如為首次進站則建立 `session` 並更新資料表中的進站人數。
6. 要注意的是原本的版型檔案中使用 `iframe` 的方式來傳遞表單資料，因此 `<form>` 標籤中會有 `target="back"` 的設定，但我們不打算使用iframe，因此要拿掉 `index.php`及`admin.php`中的 `<iframe>`，並將原本的 `<form>` 標籤內容略做修改：

```html
form method="post" target="back" action="?do=tii"
  改成
form method="post" action="./api/total.php"
```
7. 將 `$_SESSION['total']` 套用在 `index.php`及`admin.php`的進站總人數位置，或是直接從資料表讀取資料來顯示也可以
8. 完成進站人數的統計後，可以按照一樣的流程來製作頁尾版權文字，不過頁尾版權文字可以省略 `session` 的使用，直接從資料表中取得資料即可
9. 完成頁尾版權的後台功能後，在 `footer.php` 中加入讀取頁尾版權資料的程式碼，如此一來 `index.php`及`admin.php` 就可以同時看到頁尾版權資料的內容

---

## 步驟七：製作後台網站標題管理功能
除了 `total`及`bottom`，其他七項後台的功能版面都很像，我們先以"網站標題管理"這個功能來做示範，先完成這個功能後，相同的程式碼可以快速套用到其它功能去；
我們需要先把素材提供的html整理一下，以符合我們解題的需要，另外，素材並沒有附上**新增資料**及**更新圖片**的表單格式，因此這部份的HTML碼要我們自己來撰寫：
1. 依照 `total` 的原則，先移除 `iframe` 及修改 `<form>` 標籤的內容
2. 依照功能的要求修改列表欄位的HTML碼
3. 建立一個資料表名專用的變數來取代手動變更資料表名
4. 撰寫列出資料表內容的語法，依照各功能的要求，每個功能的語法可能略有不同
5. 將彈出視窗的js函式 `op` 套用到**更新圖片**按鈕中
6. 在彈出視窗的語法中加入必要的網址參數，如 `id`
7. 建立一個 `view` 資料夾來存放使用ajax載入的彈出視窗內容
8. 指定新增/更新/編輯三個不同功能對應的api檔案及路徑名，如果需要帶入參數的也需一併填寫。
   * 需注意功能中是否需要判斷檔案上傳的動作
   * 需注意資料表名及函式的參數引用是否適合
   * 和檔案相關的操作要注意路徑或是檔案覆蓋的問題
   * 瀏灠器不會主動更新同檔名的圖片，因此在更新圖片的功能中，我們採用更新資料表內容的方式來強迫瀏灠器去更新圖片
   * 確認 `./img/` 目錄存在，上傳的檔案才有地方放

```
note:
實際解題時如果一個功能一個功能照順序做，那幾乎不太可能在時間完成，
因此這邊只是示範單一功能的完整開發過程；
實際解題時，會同時考量多個類似功能的情形，並在完成一個模組後，快速複製套用；
比如我們設計了一個資料表名稱的變數$useTable，在完成標題管理的HTML程式碼後，
可以先把修改好的HTML碼快速複製到類似的ad,mvim,image,news,admin,menu去，
然後修改欄位到符合題目要求，接著變更變數$useTable的值，
這樣就可以快速完成前端頁面的HTML碼處理，然後再接著寫API，
API的撰寫也會考量是否可以同時適用多個功能。
```

---

## 步驟八：套用後台的title頁面設計到其他後台功能中
完成網站標題圖片管理的功能後，其它七個後台項目的畫面及功能都差不多，所以可以快速的複製相關的內容過去，由於我們有先設了一個資料表的變數在，因此只需要變更這個變數的值，就可以確保其它功能或網址對應到的資料表名稱都是正確的。

相應的新增及更新圖片的表單檔案也是如法泡製的快速複製就可以了，如果不想檔案數太多，則使用switch case的方式來集中內容在一個檔案中也可以。

這個步驟中比較花時間的地方在於調整欄位到符合題目要求，建議要多練幾次，把各功能的欄位熟悉一下，速度才會快。

除了 `./admin/`目錄中的檔案，也要記得同時修改　`./view/` 目錄中對應的彈出視窗

在表單的傳送目標 `action` 屬性，根據不同的功能，要記得修改不同的目標，如果是圖片上傳的表單，記得加上編碼宣告 `enctype="multipart/form-data"` 。

由於每個項目除了欄位外，都還有一些小地方有不同，因此在修改時要特別細心：
  * 除了標題圖片外，其他的項目顯示都是可多選的
  * 最新消息管理是使用 `textarea` 而不是 `input` 來顯示內容
  * 動態文字廣告及最新消息的文字欄位大小可以使用行內樣式直接調整即可
  * 校園映像圖片的顯示大小題目有要求，前台150x103，後台100x68，一樣使用行內樣式來設定即可
  * 動畫圖片中要使用 `<embed src=''></embed>` 才會產生動畫效果

最後，記得檢查一下每個功能中，使用彈出視窗功能時，有沒有帶入對應的值或參數。

---

## 步驟九：修改api中的 add / edit 中和資料表有關的程式碼

在先前的**網站標題圖片**的項目中，我們讓資料的欄位名稱都相同，所以在API中，我們使用$data陣列在存放資料時，這個陣列的內容和資料表的欄位必須是一致的，因此才能使用save()這個函式去做新增和更新的動作。

但是在管理者帳號和選單資料表中，資料表的欄位和我們在API中使用的不同，因此會造成在新增及更新時，函式無法送出符合資料表欄位的語法，因此管理者帳號和選單資料表這兩個功能無法新增及編輯。

在原本的edit程式中，我們處理資料是否顯示是採用單選的方式來處理，但是除了**網站標題圖片**外的功能大多都是多選的，因此這部份的程式也需要做修改。

針對以上提到的有差異的地方，我們採用 switch...case 的方式，讓不同資料表對應的功能可以在api的地方做出差異。

```php
        //依據不同的資料表來做不同的動作
        switch($table){
            case "title":
                //將欄位內容更新成表單傳遞過來的內容
                $data['text']=$_POST['text'][$key];
                $data['sh']=($id==$_POST['sh'])?1:0;
            break;
            case "admin":
                $data['acc']=$_POST['acc'][$key];
                $data['pw']=$_POST['pw'][$key];                
            break;
            case "menu":
                $data['text']=$_POST['text'][$key];
                $data['href']=$_POST['href'][$key];
                $data['sh']=(in_array($id,$_POST['sh']))?1:0;                  
            break;
            default:
                //將欄位內容更新成表單傳遞過來的內容
                $data['text']=$_POST['text'][$key];
                $data['sh']=(in_array($id,$_POST['sh']))?1:0;
        }

```

我們在API這邊設計的主要考量是希望功能類似的就儘量套用同樣的程式碼，因此我們透過$table這個變數，讓同一支API程式可以自動去判斷要對那一張資表進行操作，這樣才可以大幅度的減少需要撰寫的程式碼，同時透過變數的應用，也可以減低出錯率。

---

## 步驟十：製作編輯次選單功能
次選單功能是本題組中較為複雜，但說明卻相對模糊的功能，這裏我們採用較直覺的做法來解題，依照題目給出的參考圖來看，題目希望次選單的新增/修改/刪除都在彈出視窗中完成。

由於一個畫面的表單中要同時具有增改刪查的功能，因此我們無法延用先前製作的API來處理次選單的功能，所以次選單的API單獨一支程式來處理，因此我們在 `./admin/menu.php` 的彈出視窗的按鈕參數上採用指定路徑檔名的方式來處理，而不是和先前幾個功能一樣採用帶入資料表變數的方式。

在API的部份，我們透過表單中的name屬性命名(**text vs text2 ; href vs href2**)，區分出那些資料是屬於新增的，而那些資料是屬於改和刪的，這邊是較複雜的地方，需要花點時間理解一下。

* 修改 `./admin/menu.php` 中編輯次選單按鈕連結及參數
* 在 `./view/` 目錄下建立一個 `sub_menu.php` 的檔案做為編輯次選單的主要畫面
* 編輯 `./view/sub_menu.php` 以符合參考圖的呈現格式
* 在 **更多次選單** 上加入 `onclick` 事件呼叫 `moreSub()` 程式來動態產生輸入欄位
* 新增用的欄位名應該要和從資料庫撈出來的不一樣，才能做識別(ex. text vs text2)
* 新增 `./api/sub_menu.php` 撰寫編輯次選單的功能
* 依照POST內容的欄位名稱來決定要執行的是新增或是修改或是兩者同時都有。
* 這邊我們採用表單送出的行為(submit)，也就是整個頁面會跳去 `./api/sub_menu.php` 處理完再跳回 `admin.php?do=menu`，跳回來時不會再彈出視窗，但是可以看到次選單的數目改變。
* 如果希望保留彈出視窗，那麼就要改用AJAX的方式來撰寫程式。
* 記得要把主選單的**id**一併送出，才知道是誰的次選單，這邊我們使用 `hidden` 欄位來存放主選單id
* 修改 `./admin/menu.php` 中列表主選單的條件(`["parent"=>0]`)
* 最後補上次選單數的計算及顯示(使用nums()函式來計算次選單數)

---

## 步驟十一：製作分頁功能
本題組一共有三個地方會使用到分頁功能， `校園映像圖片`、`最新消息資料`、`更多消息`，其中兩個在後台，一個在前台，我們只需要做好一個分頁功能，利用變數的設定，就可以把程式碼複製給其它二個功能使用。

而在乙級的四個題組中，分頁功能的使用有三題，因此一定要熟悉分頁的製作方式。

* 先取得資料表中的總筆數(要注意是否有條件限制，比如全部列出或是只列出顯示設定為1的資料)
* 設定每個頁面要列出的資料筆數
* 計算總頁數(無條件進位法)
* 採用網址參數的方式來取得當前頁，預設為第一頁
* 計算資料的開始筆數( **(當前頁-1)*每頁筆數** )
* 下SQL查詢語法( **LIMIT start,amount** )
* 列出資料

完成 `image`及`news` 的分頁製作後，後台的主要功能也完成90%了，剩下的是一些小調整，我們會放在前台製作時再一併處理。