<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    exclude-result-prefixes="xs"
    version="2.0">
    <xsl:template match="/">
        <html>
            <head>
                <title>Catálogo VOD</title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
                    rel="stylesheet" />
                <script
                    src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" />
                <style type="text/css">
                    body {
                    margin: 20px;
                    background-color: #ffffff;
                    font-family: Verdana, Helvetica, sans-serif;
                    font-size: 90%;
                    }


                    h1 {
                    color: #005825;
                    border-bottom: 1px solid #005825;
                    text-align: center;
                    }

                    h2 {
                    font-size: 1.2em;
                    color: #4A0048;
                    text-align: center;
                    }


                </style>
            </head>
            <body>
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <div>
                        <img class="rounded" src="netflix.png" alt="Logo" width="130px"
                            height="80px" />
                    </div>
                    <div>
                        <h1>Catálogo VOD</h1>
                    </div>
                </div>
                <h2 class="display-6">Perfil de Usuario</h2>
                <xsl:for-each select="/CatalogoVOD/cuenta/perfiles/perfil">
                    <p class="h5">
                        <strong>Usuario:</strong>
                        <xsl:value-of select="@usuario" />
                        <br />
                        <strong>Idioma:</strong>
                        <xsl:value-of select="@idioma" />
                    </p>
                </xsl:for-each>
                <div class="container mt-3">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="table-dark">
                                <th colspan="4">Peliculas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary fw-bold">
                                <td>Título</td>
                                <td>Duración</td>
                                <td>Género</td>
                            </tr>
                            <xsl:for-each select="/CatalogoVOD/contenido/peliculas/genero/titulo">
                                <tr>
                                    <td>
                                        <xsl:value-of select="." />
                                    </td>
                                    <td>
                                        <xsl:value-of select="@duracion" />
                                    </td>
                                    <td>
                                        <xsl:value-of select="../@nombre" />
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
                <div class="container mt-3">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr class="table-dark">
                                <th colspan="4">Series</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary fw-bold">
                                <td>Título</td>
                                <td>Duración</td>
                                <td>Género</td>
                            </tr>
                            <xsl:for-each select="/CatalogoVOD/contenido/series/genero/titulo">
                                <tr>
                                    <td>
                                        <xsl:value-of select="." />
                                    </td>
                                    <td>
                                        <xsl:value-of select="@duracion" />
                                    </td>
                                    <td>
                                        <xsl:value-of select="../@nombre" />
                                    </td>
                                </tr>
                            </xsl:for-each>
                        </tbody>
                    </table>
                </div>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>