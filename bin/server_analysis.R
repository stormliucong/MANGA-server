setwd("/var/www/html/loh/bin")
library("ggplot2");
info = read.table("phenolyzer_info.txt",quote = "",na.strings = "NA",sep="\t",header=TRUE);
days_freq = table(info$TIME);
days_frame = data.frame(day =names(days_freq), job_number =c(unname(days_freq)), type=1 );
myPlot = ggplot(days_frame, aes(x=day, y=job_number,group=type))+geom_point(color="#3333cc")+geom_line(color="#33aabb") + theme_bw() +
theme(axis.text.x = element_text(size=rel(0.8),angle = 80, vjust = 0.5, color="#3333cc"))+ylab("Submission Count");
ggsave(filename="server_daily_submission.png", plot=myPlot);