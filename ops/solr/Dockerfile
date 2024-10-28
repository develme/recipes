FROM solr:9.7 AS solr

USER root
RUN mkdir /opt/solr/data
RUN chown solr:solr /opt/solr/data

USER solr
