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