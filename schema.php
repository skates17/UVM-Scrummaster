<pre> 
CREATE TABLE IF NOT EXISTS tblUser (
    pmkUsername varchar(20) NOT NULL,
    fldPass varchar(20) NOT NULL,
    fldCleaner BOOLEAN NOT NULL,
    fldPhone int(11) NOT NULL,
    fldRating int(5) NOT NULL,
    fldPhoto varchar(100) NOT NULL,
    fldLocation varchar(50) NOT NULL,
    fldDescription varchar(1000) NOT NULL,
     PRIMARY KEY (pmkUsername) 
     );    
</pre>

<pre>
CREATE TABLE IF NOT EXISTS tblForum (
    pmkPostId varchar(20) NOT NULL,
    fnkUsername varchar(20) NOT NULL,
    fldPhoto varchar(100) NOT NULL,
    fldPrice int(10) NOT NULL,
    fldComment varchar(500) NOT NULL,
    fldLocation varchar(100) NOT NULL,
     PRIMARY KEY (pmkPostId) 
     );
</pre>

<pre>
CREATE TABLE IF NOT EXISTS tblReview (
    pmkReviewId varchar(20) NOT NULL,
    fnkUsername varchar(20) NOT NULL,
    fldReview varchar(1000) NOT NULL,
    fldRating int(5) NOT NULL,
     PRIMARY KEY (pmkReviewId) 
     );
</pre>

<pre>
    CREATE TABLE IF NOT EXISTS  tblReviews  (
    pmkReviewId  int(11) NOT NULL,
    fldStatus  int(11) NOT NULL,
    fldRating  int(2) NOT NULL,
    fldComments  longtext NOT NULL,
    fldNice  tinyint(1) NOT NULL,
    fldFunny  tinyint(1) NOT NULL,
    fldGoodCleaner  tinyint(1) NOT NULL,
    fldGoodMusic  tinyint(1) NOT NULL,
    fldBadCleaner  tinyint(1) NOT NULL,
    fldUncomfortable  tinyint(1) NOT NULL,
    fldMean  tinyint(1) NOT NULL,
    fldLate  tinyint(1) NOT NULL,
    fnkNetId  varchar(12) NOT NULL,
    fnkRevieweesNetId  varchar(12) NOT NULL,
    fldApproved  int(1) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
</pre>