FROM nginx:1.17-alpine

LABEL maintainer "D.Horiyama"

RUN set -eux

# ----------------------------------------
# install entrykit
# ----------------------------------------
ENV ENTRYKIT_VERSION 0.4.0
RUN wget https://github.com/progrium/entrykit/releases/download/v${ENTRYKIT_VERSION}/entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && tar -xvzf entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && rm entrykit_${ENTRYKIT_VERSION}_Linux_x86_64.tgz \
  && mv entrykit /bin/entrykit \
  && chmod +x /bin/entrykit \
  && entrykit --symlink


ADD default.conf.tmpl /etc/nginx/conf.d/default.conf.tmpl
RUN cat /etc/nginx/conf.d/default.conf.tmpl

ENTRYPOINT [\
    "render", \
      "/etc/nginx/conf.d/default.conf", "--", \
    "prehook", \
      "cat /etc/nginx/conf.d/default.conf", "--" \
]

CMD ["nginx", "-g", "daemon off;"]
